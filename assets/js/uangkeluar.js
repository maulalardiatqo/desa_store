$(document).ready( function () {

    // function 
    function setInputForm({id,type,keterangan,jumlah,idSiswa,tanggalPengeluaran}){
        $('#id').val(id)
        $('#type').val(type).change()
        $('#keterangan').val(keterangan)
        $('#jumlah').val(formatNumber(jumlah.toString()))
        $('#id_siswa').val(idSiswa).change()
        document.getElementById('tanggal_pengeluaran').valueAsDate = tanggalPengeluaran;
        initDecimalInput()
    }
    // function
    
    // event listener
    $('#type').change(function(){
        let value = $('#type').val();
        
        if(value == 1){
            $('#input_id_siswa').removeClass('d-none');
        }else{
            $('#input_id_siswa').addClass('d-none');
        }
    });

    $('.btn-edit').click(function(){
        let tanggalPengeluaran = new Date($(this).data('tanggalpengeluaran'));
        let data ={
            id : $(this).data('id'),
            type : $(this).data('type'),
            keterangan : $(this).data('keterangan'),
            jumlah : $(this).data('jumlah'),
            idSiswa : $(this).data('id_siswa'),
            tanggalPengeluaran : tanggalPengeluaran
        }
        setInputForm(data)
        console.log("Edit",data)
    });

    $('#exampleModal').on('hidden.bs.modal', function () {
        // do something…
        let tanggalPengeluaran = new Date();
        let data ={
            id : '',
            type : 0,
            keterangan : '',
            jumlah : '',
            idSiswa : 0,
            tanggalPengeluaran : tanggalPengeluaran
        }
        setInputForm(data)
    })
    // event listener
} );