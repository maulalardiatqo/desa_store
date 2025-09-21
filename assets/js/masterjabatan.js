$(document).ready( function () {

    console.log("TEST");
    // function 
    function setInputForm({id,desc,role_id}){
        $('#id').val(id)
        $('#desc').val(desc)
        $('#role_id').val(role_id)
    }
    // function
    
    // event listener
    $('.btn-add').click(function(){
        let data ={
            id : null,
            desc : null,
            role_id : null
        }
        setInputForm(data)
    })

    $('.btn-edit').click(function(){
        let tanggalPemasukan = new Date($(this).data('tanggalpemasukan'));
        let data ={
            id : $(this).data('id'),
            desc : $(this).data('desc'),
            role_id : $(this).data('role')
        }
        console.log(data)
        setInputForm(data)
    });

    $('#exampleModal').on('hidden.bs.modal', function () {
        // do something…
        let data ={
            id : null,
            keterangan : null,
            role_id : null
        }
        setInputForm(data)
    })
    // event listener
} );