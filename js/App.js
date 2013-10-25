Kauzality.App = function() {
	
}

Kauzality.App.prototype = {

	init: function( data ) {
		
	    this.filterPanel = new Kauzality.FilterPanel();
	    this.groupPanel = new Kauzality.GroupPanel();

	    //add events
	    var self = this; 
	    this.$document = $( document );
    	this.$document.on( Kauzality.FilterPanel.FILTERS_PANEL_OPEN, function( event ) {
        	self.groupPanel.closePanel();
    	}).on( Kauzality.GroupPanel.GROUP_PANEL_OPEN, function( event ) {
        	self.filterPanel.closePanel();
    	});

		this.graph = new Kauzality.Graph( data );

		var $svg = $("svg");
		this.mouseDownTime;
		$svg.on( "mousedown", function( evt ) {
			self.mouseDownTime = new Date().getTime();
		}).on( "mouseup", function( evt ) {
			self.onSvgMouseUp( evt );
		});

	    var zoomPanel = $( "#zoom-panel" );
	    var zoomInBtn = zoomPanel.find( ".zoom-in" );
	    var zoomOutBtn = zoomPanel.find( ".zoom-out" );
	    zoomInBtn.on( "click", $.proxy( this.onZoomInBtnClick, this ) );
	    zoomOutBtn.on( "click", $.proxy( this.onZoomOutBtnClick, this ) );

	},

	onSvgMouseUp: function( evt ) {

		var target = evt.target;
        if( target && target.tagName == "svg" ) {
           	
        	//check last time of mouse down
        	var now = new Date().getTime();
        	var timeDiff = now - this.mouseDownTime;

        	if( timeDiff < 150 ) {
        		if( this.graph ) this.graph.closePopup();
        	}
        
        }

	},

	onZoomInBtnClick: function( evt ) {
		evt.preventDefault();
		this.graph.zoomIn();
	},	

	onZoomOutBtnClick: function( evt ) {
		evt.preventDefault();
		this.graph.zoomOut();
	},

	onZoomed: function( ) {
		console.log( "onZoomed" );
	},

	getFilters: function() {

		if( this.filterPanel ) {
			return this.filterPanel.filters;
		}
		return null;

	}

}