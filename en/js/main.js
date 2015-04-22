
function initTable() {

	var deleteBtns = $( ".delete a" ).on( "click", function( evt ) {
		
		//confirm before deleting 
		evt.preventDefault();
			
		var $a = $( this );
		var redirectLink = $a.attr( "href" );
		var answer = confirm( "Opravdu smazat?" );
		
		if( answer ) {
			window.location = redirectLink;
		}

	} );

}

function initForm() {
	/*var $dateInput = $( "input[name=date_of_birth]" );
	if( $dateInput.length > 0 ) {
		$dateInput.datepicker({
			dateFormat: 'yy-mm-dd',
	    	timeFormat: 'HH:mm:ss'
   		 });
	}
	
	$dateInput = $( "input[name=date_of_start]" );
	if( $dateInput.length > 0 ) {
		$dateInput.datepicker({
			dateFormat: 'yy-mm-dd',
	    	timeFormat: 'HH:mm:ss'
   		 });
	}

	$dateInput = $( "input[name=date_of_end]" );
	if( $dateInput.length > 0 ) {
		$dateInput.datepicker({
			dateFormat: 'yy-mm-dd',
	    	timeFormat: 'HH:mm:ss'
   		 });
	}*/

	
}


