<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    const elementTypeDecimal=document.getElementsByClassName('decimal-input')

    
    // function formatNumber(number,format){
    //     return numeral(number).format(format);
    // }

    function formatNumber(angka,prefix){
        // angka=angka.replace('.',',');
        console.log("Angka",angka)
        

        var number_string = angka.replace(/[^.\d]/g, '').toString(),
        split   		= number_string.split('.'),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }

        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ?  rupiah : '');
    }

    function initDecimalInput(){
        for (let index = 0; index < elementTypeDecimal.length; index++) {
            const elm = elementTypeDecimal[index];
            var val=elm.value ? elm.value : elm.innerText;
            console.log(elm)
            if(val){
                var format=formatNumber(val);
                try {
                    // type input
                    elm.value=format
                } catch (error) {
                    // !type input
                    elm.innerText=format
                    
                }
            }
        }
    }

    if(elementTypeDecimal.length > 0){
        initDecimalInput()
    }

    $('.decimal-input').on('keyup',function(e){
        var string = formatNumber($(this).val());
        $(this).val(string);
    });


    // $('.decimal-input').on('keyup',function(e){
    //     if(e.keyCode == 8){
    //         return false
    //     }
    //     var numberValue=this.value
    //     console.log(numberValue)
    //     var string = formatNumber(numberValue,'0,0.00');
    //     e.target.value=string;
    //     // $(this).val(string);
    // });

</script>