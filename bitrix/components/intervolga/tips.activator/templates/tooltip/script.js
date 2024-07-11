/**
 * Pseudo-namespace for component js-code.
 */
function intervolgaTips() {}
/**
 * Possible tooltip positions
 *
 * @type {string[]}
 */
intervolgaTips.arPositions = [
	"TOP_LEFT",
	"TOP",
	"TOP_RIGHT",
	"RIGHT",
	"BOTTOM_RIGHT",
	"BOTTOM",
	"BOTTOM_LEFT",
	"LEFT",
];
/**
 * Returns element position.
 *
 * @param {Element} elem
 */
intervolgaTips.getPosition = function(elem){
	var getOffsetSum = function(elem) {
		var top=0, left=0;
		while(elem) {
			top = top + parseInt(elem.offsetTop);
			left = left + parseInt(elem.offsetLeft);
			elem = elem.offsetParent;
		}

		return {top: top, left: left}
	};
	var getOffsetRect = function (elem) {
		var box = elem.getBoundingClientRect();

		var body = document.body;
		var docElem = document.documentElement;

		var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;

		var clientTop = docElem.clientTop || body.clientTop || 0;
		var clientLeft = docElem.clientLeft || body.clientLeft || 0;

		var top  = box.top +  scrollTop - clientTop;
		var left = box.left + scrollLeft - clientLeft;

		return { top: Math.round(top), left: Math.round(left) }
	};

	if (elem.getBoundingClientRect)
		return getOffsetRect(elem);

	return getOffsetSum(elem);
};

/**
 * Returns tooltip html code.
 *
 * @param {Object} arTip tip data object
 * @param {string} sTooltipId id
 * @returns {string} tip tooltip html
 */
intervolgaTips.createTooltipElement = function(arTip, sTooltipId){
	var obTemplate = BX("intervolgaTipsTemplateTooltip");
	return BX.create({
		tag: obTemplate.tagName,
		props: {
			className: obTemplate.getAttribute("class"),
			id: sTooltipId
		},
		html: obTemplate.innerHTML.replace("#TOOLTIP#", arTip["TOOLTIP"])
	});
};

/**
 * Checks if tooltip is fully visible
 *
 * @param {Element} obTooltip
 * @param {number} top
 * @param {number} left
 * @returns {boolean}
 */
intervolgaTips.checkTooltipIsVisible = function(obTooltip, top, left) {
	var right = obTooltip.offsetWidth + left,
		bottom = obTooltip.offsetHeight + top;

	if (bottom < 0 || top < 0) {
		return false;
	}
	if (left < 0 || right < 0) {
		return false;
	}
	if (bottom > document.body.clientHeight || top > document.body.clientHeight) {
		return false;
	}
	if (left > document.body.clientWidth || right > document.body.clientWidth) {
		return false;
	}

	return true;
};

/**
 * Returns next tooltip position to try
 *
 * @param {string} failedPosition previous tried position
 * @returns {string}
 */
intervolgaTips.getNextPosition = function(failedPosition) {
	if (failedPosition) {
		for (var i in intervolgaTips.arPositions) {
			i = parseInt(i);
			if (failedPosition == intervolgaTips.arPositions[i]) {
				if (intervolgaTips.arPositions[i + 1]) {
					return intervolgaTips.arPositions[i + 1];
				}
				break;
			}
		}
	}
	return intervolgaTips.arPositions[0];
};

/**
 * Returns tooltip position parameters
 *
 * @param {string} position
 * @param {Element} obHint
 * @param {Element} obTooltip
 * @returns {{className: string, top: number, left: number}}
 */
intervolgaTips.getPositionParameters = function(position, obHint, obTooltip) {
	var arrowSize = 5;     // Depends on styles
	var arrowMargin = 5;   // Depends on styles

	var arResult = {className: "", top: 0, left: 0};

	if (position == "LEFT") {
		arResult.className = "iv-tooltip-left";
		arResult.top += -Math.round(obTooltip.offsetHeight / 2) + Math.round(obHint.offsetHeight/2);
		arResult.left += -obTooltip.offsetWidth - arrowSize;
	}
	else if(position == "RIGHT"){
		arResult.className = "iv-tooltip-right";
		arResult.top += -Math.round(obTooltip.offsetHeight / 2) + Math.round(obHint.offsetHeight/2);
		arResult.left += obHint.offsetWidth;
	}
	else if (position == "TOP") {
		arResult.className = "iv-tooltip-top";
		arResult.top += -obTooltip.offsetHeight - arrowSize;
		arResult.left += -Math.round(obTooltip.offsetWidth / 2) + Math.round(obHint.offsetWidth/2);
	}
	else if (position == "TOP_LEFT") {
		arResult.className = "iv-tooltip-top-left";
		arResult.top += -obTooltip.offsetHeight - Math.round(obHint.offsetHeight/2);
		arResult.left += -obTooltip.offsetWidth + obHint.offsetWidth + arrowMargin + arrowSize - Math.round(obHint.offsetWidth / 2);
	}
	else if (position == "TOP_RIGHT") {
		arResult.className = "iv-tooltip-top-right";
		arResult.top += -obTooltip.offsetHeight - Math.round(obHint.offsetHeight/2);
		arResult.left += -arrowMargin - arrowSize + Math.round(obHint.offsetWidth/2);
	}
	else if (position == "BOTTOM_LEFT") {
		arResult.className = "iv-tooltip-bottom-left";
		arResult.top += obHint.offsetHeight + arrowSize;
		arResult.left += -obTooltip.offsetWidth + obHint.offsetWidth + arrowMargin + arrowSize - Math.round(obHint.offsetWidth / 2);
	}
	else if (position == "BOTTOM_RIGHT") {
		arResult.className = "iv-tooltip-bottom-right";
		arResult.top += obHint.offsetHeight + arrowSize;
		arResult.left += -arrowMargin - arrowSize + Math.round(obHint.offsetWidth/2);
	}
	else {  // BOTTOM
		arResult.className = "iv-tooltip-bottom";
		arResult.top += obHint.offsetHeight;
		arResult.left += -Math.round(obTooltip.offsetWidth / 2) + Math.round(obHint.offsetWidth/2);
	}

	return arResult;
};

/**
 * Shows tooltip in its position
 *
 * @param {Element} obTooltip tooltip element
 * @param {string} preferredPosition tooltip position (LEFT, LEFT_TOP, RIGHT, etc)
 * @param {Element} obHint label element
 */
intervolgaTips.placeTooltip = function(obTooltip, preferredPosition, obHint) {
	var labelPosition = intervolgaTips.getPosition(obHint),
		currentPosition = preferredPosition,
		top = 0,
		left = 0,
		positionParams = null;

	if (!currentPosition) {
		currentPosition = intervolgaTips.getNextPosition();
	}
	for (var i = 0; i < intervolgaTips.arPositions.length; i++)
	{
		// Try currentPosition
		positionParams = intervolgaTips.getPositionParameters(currentPosition, obHint, obTooltip);

		top = labelPosition.top + positionParams.top;
		left = labelPosition.left + positionParams.left;

		if (intervolgaTips.checkTooltipIsVisible(obTooltip, top, left)) {
			obTooltip.className = "iv-tooltip iv-tooltip-in " + positionParams.className;
			obTooltip.style.top = top + 'px';
			obTooltip.style.left = left + 'px';

			return;
		}
		else {
			// Try next position
			currentPosition = intervolgaTips.getNextPosition(currentPosition);
		}
	}

	// If nothing fits, display in default position
	currentPosition = preferredPosition;
	if (!currentPosition) {
		currentPosition = intervolgaTips.getNextPosition();
	}
	positionParams = intervolgaTips.getPositionParameters(currentPosition, obHint, obTooltip);

	top = labelPosition.top + positionParams.top;
	left = labelPosition.left + positionParams.left;

	obTooltip.className = "iv-tooltip iv-tooltip-in " + positionParams.className;
	obTooltip.style.top = top + 'px';
	obTooltip.style.left = left + 'px';
};

/**
 * Removes previously created tooltip html elements
 */
intervolgaTips.removeTipsCache = function() {
	var arNodeWithTips = BX.findChildren(
		document.body,
		{
			attribute: "data-intervolga-tips-id"
		},
		true
	);
	if (arNodeWithTips) {
		for (var i in arNodeWithTips) {
			var sTooltipId = arNodeWithTips[i].getAttribute("data-tooltip-id");
			if (sTooltipId) {
				var obTooltip = BX(sTooltipId);
				if (obTooltip != null) {
					BX.remove(obTooltip);
					arNodeWithTips[i].removeAttribute("data-tooltip-id")
				}
			}
		}
	}
};

/**
 * Finds all tip-marked nodes on the page and adds tip decoration.
 * @param {string} preferredPosition
 */
intervolgaTips.activate = function(preferredPosition) {
	if (window.intervolga_tips) {
		// Find all tip markers
		var arNodeWithTips = BX.findChildren(
			document.body,
			{
				attribute: "data-intervolga-tips-id"
			},
			true
		);
		if (arNodeWithTips) {
			// For each tip marker
			for (var i in arNodeWithTips) {
				// Bind "mouse in" event listener
				BX.bind(arNodeWithTips[i], 'mouseover', function() {
					var iTip = this.getAttribute("data-intervolga-tips-id");
					if (window.intervolga_tips[iTip]) {
						var sTooltipId = this.getAttribute("data-tooltip-id");
						var obTooltip = null;
						if (sTooltipId) {
							// Find existing tooltip
							obTooltip = BX(sTooltipId);
						}
						else {
							// Create tooltip
							sTooltipId = "intervolgaTip_" + iTip + "_" + Math.floor((1 + Math.random() * 999999));
							this.setAttribute("data-tooltip-id", sTooltipId);
							obTooltip = intervolgaTips.createTooltipElement(window.intervolga_tips[iTip], sTooltipId);
							document.body.appendChild(obTooltip);
						}

						if (obTooltip != null) {
							obTooltip.className = "iv-tooltip iv-tooltip-in";
							obTooltip.style.display = "block";
							intervolgaTips.placeTooltip(obTooltip, preferredPosition, this);
						}
					}
				});
				// Bind "mouse out" event listener
				BX.bind(arNodeWithTips[i], 'mouseout', function() {
					// Find tooltip for marker
					var sTooltipId = this.getAttribute("data-tooltip-id");
					var obTooltip = BX(sTooltipId);
					if (obTooltip != null) {
						// Hide tooltip
						obTooltip.style.display = "none";
					}
				});
			}
		}
	}
	BX.bind(window, 'resize', function() {
		// As it may be some problems after resize, all previously created tooltips must be removed
		intervolgaTips.removeTipsCache();
	});
};