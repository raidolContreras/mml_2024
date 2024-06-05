
$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    if (team >= 1) {
        $('.matrix').css('display', 'block');
    } else {
        $('.matrix').css('display', 'none');
    }
});