function JCDktklandinfo(arParams)
{
	var _this = this;
	
		this.arParams = {
			'ITEMS':arParams.items,
		};
		
		
		
		this.Init = function() {
			console.log('INIT');
			console.log(_this.arParams.ITEMS);
		}
		
		BX.ready(function (){
			_this.Init(arParams);
		});
		
}