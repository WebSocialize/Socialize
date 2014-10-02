$(document).ready(function()
{
	$( "#datepicker2" ).datepicker(
    {
      monthNamesShort: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dec"],
      changeMonth: true,
      changeYear: true,
      dateFormat:"dd-mm-yy",
      yearRange: "1900:thisYear",
      maxDate: "today",
      defaultDate:"01-01-2000",
    });
});