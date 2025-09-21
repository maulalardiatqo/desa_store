$(document).ready(function(){

    function calculate(){
        let tagihan = $('#jumlah').val().replaceAll(",","")
        let sudahdibayar = $('#sudahdibayar').val().replaceAll(",","")
        let bayar = $('#bayar').val()
        let kurang = Number(tagihan) - (Number(bayar) + Number(sudahdibayar))
        console.log("Kurang",kurang)
        if(kurang > 0){
            kurang=formatNumber(kurang.toString())
            $('#kurang').val(kurang)
            $('#container-kurang').removeClass('d-none')
        }else{
            $('#container-kurang').addClass('d-none')
            $('#kurang').val(0)
        }
    }


    $('.checkbox-kelas').change(function(){
        let isChecked = $(this).prop('checked')
        let index=$(this).data('index')
        $(`.checkbox-${index}`).prop('checked',isChecked)
    })

    $('#myForm').submit(function(e){
        // e.preventDefault()
    })

    $('.btn-bayar').click(function(){
        let id= $(this).data('id');
        let to= $(this).data('to');
        let sudahdibayar= $(this).data('sudahdibayar');
        $('#id').val(id);
        $('#to').val(to);
        $('#sudahdibayar').val(formatNumber(sudahdibayar.toString())).change();
    })

    $('#bayar').on('input',function(){
        calculate()
    })
    $('#sudahdibayar').on('change',function(){
        console.log("change")
        calculate()
    })
})