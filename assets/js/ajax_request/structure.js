
$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    if (team >= 1) {
        $('.Structure').css('display', 'block');
    } else {
        $('.Structure').css('display', 'none');
    }
});