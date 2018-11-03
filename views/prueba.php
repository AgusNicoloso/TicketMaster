<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="<?= URl ?>css/bootstrap-multiselect.css" type="text/css"/>

<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript" src="<?= URl ?>js/bootstrap-multiselect.js"></script>

<title>Prueba boton</title>

<div class="container-fluid">
<select id="multiselectwithsearch" multiple="multiple">
    <option value="1">Maluma</option>
    <option value="2">Maluma</option>
    <option value="3">Maluma</option>
    <option value="4">Maluma</option>
    <option value="5">Maluma</option>
    <option value="6">Maluma</option>
</select>
</div>
<script>
$(function() {  
 $('#multiselectwithsearch').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            nonSelectedText: 'No hay seleccionado',
            nSelectedText: 'Seleccionados',
            allSelectedText: 'Todo seleccionado',
            filterPlaceholder: 'Buscar'
        }); 
});
</script>





