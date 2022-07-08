import 'bootstrap/scss/bootstrap.scss';
import './bootstrap';
import jQuery from 'jquery';
import {value} from "lodash/seq";
window.$ = jQuery;

$('#package_weight_range').on('change',function (){
    $('#packageWeight').val($(this).val());
});
$('#packageWeight').on('change',function (){
    $('#package_weight_range').val($(this).val());
});

// this is the id of the form
$("#idForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            alert(data); // show response from the php script.
        }
    });

});