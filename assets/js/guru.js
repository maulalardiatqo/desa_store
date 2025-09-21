$(document).ready(function(){
    // Event Listeners
    $('#jabatan').change(function(){
        var roleID = $(this).find("option:selected").data('role');
        console.log("ROLE ID",roleID)
        $('#role_id').val(roleID)
    })
})