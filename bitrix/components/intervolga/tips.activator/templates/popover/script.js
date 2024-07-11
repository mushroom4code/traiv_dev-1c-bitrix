/**
 * Pseudo-namespace for component js-code.
 */
function intervolgaTips() {}
/**
 * Possible popover positions
 *
 * @type {string[]}
 */
intervolgaTips.arPositions = [
	"TOP_LEFT",
	"TOP",
	"TOP_RIGHT",
	"RIGHT_TOP",
	"RIGHT",
	"RIGHT_BOTTOM",
	"BOTTOM_RIGHT",
	"BOTTOM",
	"BOTTOM_LEFT",
	"LEFT_BOTTOM",
	"LEFT",
	"LEFT_TOP"
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
 * Returns popover html code.
 *
 * @param {Object} arTip tip data object
 * @param {string} sPopoverId id
 * @returns {string} tip popover html
 */
intervolgaTips.createPopoverElement = function(arTip, sPopoverId){
	var obTemplate = BX("intervolgaTipsTemplatePopover");
	return BX.create({
		tag: obTemplate.tagName,
		props: {
			className: obTemplate.getAttribute("class"),
			id: sPopoverId
		},
		html: obTemplate.innerHTML.replace("#TOOLTIP#", arTip["TOOLTIP"])
	});
};

/**
 * Checks if popover is fully visible
 *
 * @param {Element} obPopover
 * @param {number} top
 * @param {number} left
 * @returns {boolean}
 */
intervolgaTips.checkPopoverIsVisible = function(obPopover, top, left) {
	var right = obPopover.offsetWidth + left,
		bottom = obPopover.offsetHeight + top;

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
 * Returns next popover position to try
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
 * Returns popover position parameters
 *
 * @param {string} position
 * @param {Element} obHint
 * @param {Element} obPopover
 * @returns {{className: string, top: number, left: number}}
 */
intervolgaTips.getPositionParameters = function(position, obHint, obPopover) {
	var arrowSize = 11;     // Depends on styles
	var arrowMargin = 11;   // Depends on styles

	var arResult = {className: "", top: 0, left: 0};

	if(position == "LEFT_TOP") {
		arResult.className = "iv-popover-left-top";
		arResult.top += -arrowMargin - arrowSize + Math.round(obHint.offsetHeight/2);
		arResult.left += -obPopover.offsetWidth - arrowSize;
	}
	else if (position == "LEFT") {
		arResult.className = "iv-popover-left";
		arResult.top += -Math.round(obPopover.offsetHeight / 2) + Math.round(obHint.offsetHeight/2);
		arResult.left += -obPopover.offsetWidth;
	}
	else if(position == "LEFT_BOTTOM") {
		arResult.className = "iv-popover-left-bottom";
		arResult.top += -Math.round(obPopover.offsetHeight) + obHint.offsetHeight + arrowMargin + arrowSize - Math.round(obHint.offsetHeight/2);
		arResult.left += -obPopover.offsetWidth - arrowSize;
	}
	else if(position == "RIGHT"){
		arResult.className = "iv-popover-right";
		arResult.top += -Math.round(obPopover.offsetHeight / 2) + Math.round(obHint.offsetHeight/2);
		arResult.left += obHint.offsetWidth;
	}
	else if(position == "RIGHT_TOP"){
		arResult.className = "iv-popover-right-top";
		arResult.top += -arrowMargin - arrowSize + Math.round(obHint.offsetHeight/2);
		arResult.left += obHint.offsetWidth + arrowSize;
	}
	else if(position == "RIGHT_BOTTOM"){
		arResult.className = "iv-popover-right-bottom";
		arResult.top += -Math.round(obPopover.offsetHeight) + obHint.offsetHeight + arrowMargin + arrowSize - Math.round(obHint.offsetHeight/2);
		arResult.left += obHint.offsetWidth + arrowSize;
	}
	else if (position == "TOP") {
		arResult.className = "iv-popover-top";
		arResult.top += -obPopover.offsetHeight;
		arResult.left += -Math.round(obPopover.offsetWidth / 2) + Math.round(obHint.offsetWidth/2);
	}
	else if (position == "TOP_LEFT") {
		arResult.className = "iv-popover-top-left";
		arResult.top += -obPopover.offsetHeight - Math.round(obHint.offsetHeight/2);
		arResult.left += -arrowMargin - arrowSize + Math.round(obHint.offsetWidth/2);
	}
	else if (position == "TOP_RIGHT") {
		arResult.className = "iv-popover-top-right";
		arResult.top += -obPopover.offsetHeight - Math.round(obHint.offsetHeight/2);
		arResult.left += -obPopover.offsetWidth + obHint.offsetWidth + arrowMargin + arrowSize - Math.round(obHint.offsetWidth / 2);
	}
	else if (position == "BOTTOM_LEFT") {
		arResult.className = "iv-popover-bottom-left";
		arResult.top += obHint.offsetHeight + arrowSize;
		arResult.left += -arrowMargin - arrowSize + Math.round(obHint.offsetWidth/2);
	}
	else if (position == "BOTTOM_RIGHT") {
		arResult.className = "iv-popover-bottom-right";
		arResult.top += obHint.offsetHeight + arrowSize;
		arResult.left += -obPopover.offsetWidth + obHint.offsetWidth + arrowMargin + arrowSize - Math.round(obHint.offsetWidth / 2);
	}
	else {  // BOTTOM
		arResult.className = "iv-popover-bottom";
		arResult.top += obHint.offsetHeight;
		arResult.left += -Math.round(obPopover.offsetWidth / 2) + Math.round(obHint.offsetWidth/2);
	}

	return arResult;
};


/**
 * Shows popover in its position
 *
 * @param {Element} obPopover popover element
 * @param {string} preferredPosition popover position (LEFT, LEFT_TOP, RIGHT, etc)
 * @param {Element} obHint label element
 */
intervolgaTips.placePopover = function(obPopover, preferredPosition, obHint) {
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
		positionParams = intervolgaTips.getPositionParameters(currentPosition, obHint, obPopover);

		top = labelPosition.top + positionParams.top;
		left = labelPosition.left + positionParams.left;

		if (intervolgaTips.checkPopoverIsVisible(obPopover, top, left)) {
			obPopover.className = "iv-popover iv-popover-in " + positionParams.className;
			obPopover.style.top = top + 'px';
			obPopover.style.left = left + 'px';

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
	positionParams = intervolgaTips.getPositionParameters(currentPosition, obHint, obPopover);

	top = labelPosition.top + positionParams.top;
	left = labelPosition.left + positionParams.left;

	obPopover.className = "iv-popover iv-popover-in " + positionParams.className;
	obPopover.style.top = top + 'px';
	obPopover.style.left = left + 'px';
};

/**
 * Removes previously created popover html elements
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
			var sPopoverId = arNodeWithTips[i].getAttribute("data-popover-id");
			if (sPopoverId) {
				var obPopover = BX(sPopoverId);
				if (obPopover != null) {
					BX.remove(obPopover);
					arNodeWithTips[i].removeAttribute("data-popover-id")
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
						var sPopoverId = this.getAttribute("data-popover-id");
						var obPopover = null;
						if (sPopoverId) {
							// Find existing popover
							obPopover = BX(sPopoverId);
						}
						else {
							// Create popover
							sPopoverId = "intervolgaTip_" + iTip + "_" + Math.floor((1 + Math.random() * 999999));
							this.setAttribute("data-popover-id", sPopoverId);
							obPopover = intervolgaTips.createPopoverElement(window.intervolga_tips[iTip], sPopoverId);
							document.body.appendChild(obPopover);
						}

						if (obPopover != null) {
							obPopover.className = "iv-popover iv-popover-in";
							obPopover.style.display = "block";
							intervolgaTips.placePopover(obPopover, preferredPosition, this);
						}
					}
				});
				// Bind "mouse out" event listener
				BX.bind(arNodeWithTips[i], 'mouseout', function() {
					// Find tooltip for marker
					var sPopoverId = this.getAttribute("data-popover-id");
					var obPopover = BX(sPopoverId);
					if (obPopover != null) {
						// Hide tooltip
						obPopover.style.display = "none";
					}
				});
			}
		}
	}
	BX.bind(window, 'resize', function() {
		// As it may be some problems after resize, all previously created popovers must be removed
		intervolgaTips.removeTipsCache();
	});
};