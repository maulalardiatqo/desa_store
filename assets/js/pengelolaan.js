$(document).ready( function () {

    console.log("TEST");
    // function 
    function setInputForm({id,type,desc}){
        $('#id').val(id)
        $('#type').val(type).change()
        $('#desc').val(desc)
    }
    // function
    function setInputFormSPP({id,tahunmasuk,jumlah}){
        $('#id_spp').val(id)
        $('#tahun_masuk').val(tahunmasuk).change()
        $('#jumlah').val(jumlah)
    }
    // event listener
    $('.btn-add').click(function(){
        let data ={
            id : null,
            type : $(this).data('type'),
            desc : null
        }
        setInputForm(data)
    })

    $('.btn-edit').click(function(){
        let tanggalPemasukan = new Date($(this).data('tanggalpemasukan'));
        let data ={
            id : $(this).data('id'),
            type : $(this).data('type'),
            desc : $(this).data('desc')
        }
        setInputForm(data)
    });
    $('.btn-edit-spp').click(function(){
        
        let data ={
            id : $(this).data('id'),
            tahunmasuk : $(this).data('tahunmasuk'),
            jumlah : $(this).data('jumlah')
        }
        console.log(data)
        setInputFormSPP(data)
    });

    $('#exampleModal').on('hidden.bs.modal', function () {
        // do something…
        let data ={
            id : null,
            type : null,
            keterangan : null
        }
        setInputForm(data)
    })
    // event listener
} );