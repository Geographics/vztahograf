Kauzality.FilterPanel = function() {

	this.filters = [];
	
	this.$document = $( document );
	this.$element = $( "#filter-panel" );

	this.$a = this.$element.find( "a" );
	this.$element.on( "mouseover", $.proxy( this.onMouseover, this ) );
	this.$element.on( "mouseout", $.proxy( this.onMouseout, this ) );
	this.$arrowSpan = this.$a.find( "span" );

	this.$checkboxes = this.$element.find( "input[type='checkbox']" );
	this.$checkboxes.on( "change", $.proxy( this.onCheckboxChange, this ) );
	
	this.updateFilters();

}

Kauzality.FilterPanel.prototype = {

	onMouseover: function( evt ) {

		evt.preventDefault();
		this.$element.toggleClass( "open" );

		this.$arrowSpan.toggleClass( "dropdown-arrow-up", this.$element.hasClass( "open" ) );
		//this.$document.trigger( Kauzality.FilterPanel.FILTERS_PANEL_OPEN );
	},

	onMouseout: function( evt ) {

		evt.preventDefault();
		this.$element.toggleClass( "open" );

		this.$arrowSpan.toggleClass( "dropdown-arrow-up", this.$element.hasClass( "open" ) );
		//this.$document.trigger( Kauzality.FilterPanel.FILTERS_PANEL_OPEN );
	},

	onCheckboxChange: function() {
	
		this.updateFilters();
		this.$document.trigger( Kauzality.FilterPanel.FILTERS_UPDATE );
	
	},

	updateFilters: function() {
		
		var self = this;
		this.filters = [];
		$.each( this.$checkboxes, function( i,v ) {
			$checkbox = $( v );
			if( $checkbox.attr( "checked" ) ) self.filters.push( $checkbox.val() ); 
		});

	},

	closePanel: function() {
		this.$element.removeClass( "open" );
		this.$arrowSpan.toggleClass( "dropdown-arrow-up", this.$element.hasClass( "open" ) );
	}

}

Kauzality.FilterPanel.FILTERS_UPDATE = "FilterPanelOnFilterEvent";
Kauzality.FilterPanel.FILTERS_PANEL_OPEN = "FilterPanelFiltersPanelOpenEvent";