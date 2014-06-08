/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('[data-toggle="tooltip"]').tooltip({
    'placement': 'top'
});
$('[data-toggle="popover"]').popover({
    trigger: 'hover',
        'placement': 'top'
});

$('#userNameField').tooltip({
    'show': true,
        'placement': 'bottom',
        'title': "Please remember to..."
});

$('#userNameField').tooltip('show');