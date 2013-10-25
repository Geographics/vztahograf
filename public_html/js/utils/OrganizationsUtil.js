Kauzality.utils.OrganizationsUtil = {

	getClassForOrganizationId: function( id ) {
		
		var className = "";
		switch( id ) {
			case "7":
				className = "ods";
				break;
			case "8":
				className = "top";
				break;
			case "9":
				className = "cssd";
				break;
			case "10":
				className = "kscm";
				break;
			case "15":
				className = "kdu-csl";
				break;
			case "16":
				className = "sz";
				break;
			case "29":
				className = "zeman";
				break;
			case "30":
				className = "lev";
				break;
			case "33":
				className = "ano";
				break;
		
		}
		return className;
	
	}
	
}