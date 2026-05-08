import './bootstrap';
import $ from 'jquery';
import select2 from 'select2';
select2($);
import "/node_modules/select2/dist/css/select2.css";
$(document).ready(function() {

    $('.select2').select2();
});
