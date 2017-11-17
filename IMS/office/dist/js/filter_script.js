var flag =0;

$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
 //   if(flag==1){
  //alert(flag);
      var min = parseInt( $('#min').val(), 10 );
      var max = parseInt( $('#max').val(), 10 );
      var min_math = parseInt( $('#min_math').val(), 10 );
      var max_math = parseInt( $('#max_math').val(), 10 );
      var percent = parseFloat( data[5] ) || 0; // use data for the percentage column
      var math = parseFloat( data[6] ) || 0; // use data for the maths score column

      if  ( ( isNaN( min ) && isNaN( max ) ) ||
            ( isNaN( min ) && percent <= max ) ||
            ( min <= percent   && isNaN( max ) ) ||
            ( min <= percent   && percent <= max ) )
      { 
          flag=1;
        if  ( ( isNaN( min_math ) && isNaN( max_math ) ) ||
            ( isNaN( min_math ) && math <= max_math ) ||
            ( min_math <= math   && isNaN( max_math ) ) ||
            ( min_math <= math   && math <= max_math ) ) 
        {
          
          if (flag==1){
            //alert(flag);
            return true;
        }
        return true;
      }
      }
      return false;

   // }
   /* else if(flag==2){
      var min = parseInt( $('#min_math').val(), 10 );
      var max = parseInt( $('#max_math').val(), 10 );
      var age = parseFloat( data[6] ) || 0; // use data for the age column

      if ( ( isNaN( min ) && isNaN( max ) ) ||
          ( isNaN( min ) && age <= max ) ||
          ( min <= age   && isNaN( max ) ) ||
          ( min <= age   && age <= max ) )
      {
          return true;
      }
      return false;
    }*/
  }
);
$(document).ready(function() {
    var table = $('#example1').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max, #min_math, #max_math').keyup( function() {
        //flag = 1;
        //alert(flag);
        table.draw();
    } );
  /*  $('#min_math, #max_math').keyup( function() {
        flag = 2;
        table.draw();
    } );*/

} );