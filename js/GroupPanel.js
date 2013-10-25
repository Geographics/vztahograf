Kauzality.GroupPanel = function() {

	this.filters = [];
	
	this.$document = $( document );
	this.$element = $( "#group-panel" );

	this.$a = this.$element.find( "a" );
	this.$element.on( "mouseover", $.proxy( this.onMouseover, this ) );
	this.$element.on( "mouseout", $.proxy( this.onMouseout, this ) );
	this.$arrowSpan = this.$a.find( "span" );

	this.$checkboxes = this.$element.find( "input[type='radio']" );

	var self = this;
	this.$checkboxes.on( "change", function( evt ) {
		self.onRadioChange( $(this).val() );
	});
	
}

Kauzality.GroupPanel.prototype = {

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
	
	onRadioChange: function( radioVal ) {
		
		this.$document.trigger( Kauzality.GroupPanel.GROUP_UPDATE, [ radioVal ] );
	
	},

	closePanel: function() {
		this.$element.removeClass( "open" );
		this.$arrowSpan.toggleClass( "dropdown-arrow-up", this.$element.hasClass( "open" ) );
	}

}

Kauzality.GroupPanel.GROUP_UPDATE = "GroupPanelGroupUpdateEvent";
Kauzality.GroupPanel.GROUP_PANEL_OPEN = "GroupPanelGroupPanelOpenEvent";