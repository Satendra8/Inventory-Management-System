

$(document).ready(function(){
    var date = new Date();
    var dd = date.getDate();
    var mm = date.getMonth()+1;
    var yy = date.getFullYear();
    if(mm<10){
        mm = "0"+mm;
    }
    if(dd<10){
        dd = "0"+dd;
    }
    $('#order_date').val(yy+'-'+mm+'-'+dd);
    
    var total_amt = 0;
    var count = 1;
    $(document).on('click', '#add', function(){
        count++;
        $('#total_item').val(count);

        var html_code = '';
        html_code += '<tr id="row_id_'+count+'">';
        html_code += '<td <span id="sr_no">'+count+'</span></td>';
        html_code += '<td style="text-align:center;"><input type="text" name="particulars[]" id="particulars'+count+'" data-srno="'+count+'" required/></td>';
        html_code += '<td style="text-align:center;"><input type="text" class="qty" name="qty[]" id="qty'+count+'" data-srno="'+count+'" required/></td>';
        html_code += '<td style="text-align:center;"><input type="number" class="amount" name="amount[]" id="amount'+count+'" data-srno="'+count+'"  required/></td>';
        html_code += '<td style="text-align:center;"><input type="number" class="discount" name="discount[]" id="discount'+count+'" data-srno="'+count+'" value="0"/></td>';
        html_code += '<td style="text-align:center;"><input type="text" class="total" name="total[]" id="total'+count+'" data-srno="'+count+'" readonly/></td>';
        html_code += '<td style="text-align:center;"><button type="button" class="delete" name="delete[]" id="'+count+'" data-srno="'+count+'"><img src="images/trash.svg"></button></td>';
        html_code += '</tr><br>';

        $("#invoice_item").append(html_code);
    });

    $(document).on('click', '.delete', function(){
        var row_id = $(this).attr("id");
        var total_item_amount = $('#total'+row_id).val();
        var final_amount = $('#sub_total').val();
        var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
        $('#sub_total').val(result_amount);
        $('#row_id_'+row_id).remove();
        count--;
        $('#total_item').val(count);
    });    
    
    function calculate(count){
        var final_item_total = 0;
        for(j=1;j<=count;j++){
            
            var quantity = 0;
            var price = 0;
            var discount = 0;
            var item_total = 0;

            quantity = $('#qty'+j).val();
            if(quantity > 0){
                price = $('#amount'+j).val();
                
                if(price>0){
                    item_total = parseFloat(quantity) * parseFloat(price);

                    discount = $('#discount'+j).val();
                    if(discount > 0){
                        discount = (item_total * parseFloat(discount))/100;
                    }
                    item_total = item_total - discount;
                    final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                    $('#total'+j).val(item_total);
                }
            }
        }
        $('#sub_total').val(final_item_total);
        $('#gst').val(final_item_total * 0.18);
        $('#net').val(final_item_total + (final_item_total * 0.18));
        $("#words").html(numberToWords(final_item_total + (final_item_total * 0.18)));
    }

    $(document).on('blur', '.amount', function(){
        calculate(count);
    });

    $(document).on('blur', '.qty', function(){
        calculate(count);
    });

    $(document).on('blur', '.discount', function(){
        calculate(count);
    });

    $('#order').click(function(){
        if($.trim($('#customer_name').val()).length == 0){
            alert("Please Enter Customer Name");
            return false;
        }

        if($.trim($('#particular').val()).length == 0){
            alert("Please Enter Particular");
            return false;
        }

        // if(($.trim($('#customer_gst').val()).length == 0) || ($.trim($('#customer_gst').val()).length == 15)){
        //     alert("Please Enter Valid GST");
        //     return false;
        // }

        // if(($.trim($('#customer_pan').val()).length == 0) || ($.trim($('#customer_pan').val()).length == 10)){
        //     alert("Please Enter Valid PAN");
        //     return false;
        // }

        for(var no=1; no<=count; no++){
            if($.trim($('#particulars'+no).val()).length == 0){
                alert("Please Enter Item Name");
                $('#particulars'+no).focus();
                return false;
            }

            if($.trim($('#qty'+no).val()).length == 0){
                alert("Please Enter Item Quantity");
                $('#qty'+no).focus();
                return false;
            }

            if($.trim($('#amount'+no).val()).length == 0){
                alert("Please Enter Item Price");
                $('#amount'+no).focus();
                return false;
            }

        }
        
        $('#invoice_form').submit();
        
    });

    function numberToWords(number) {  
        var digit = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];  
        var elevenSeries = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];  
        var countingByTens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];  
        var shortScale = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];  
  
        number = number.toString(); number = number.replace(/[\, ]/g, ''); if (number != parseFloat(number)) return 'not a number'; var x = number.indexOf('.'); if (x == -1) x = number.length; if (x > 15) return 'too big'; var n = number.split(''); var str = ''; var sk = 0; for (var i = 0; i < x; i++) { if ((x - i) % 3 == 2) { if (n[i] == '1') { str += elevenSeries[Number(n[i + 1])] + ' '; i++; sk = 1; } else if (n[i] != 0) { str += countingByTens[n[i] - 2] + ' '; sk = 1; } } else if (n[i] != 0) { str += digit[n[i]] + ' '; if ((x - i) % 3 == 0) str += 'Hundred '; sk = 1; } if ((x - i) % 3 == 1) { if (sk) str += shortScale[(x - i - 1) / 3] + ' '; sk = 0; } } if (x != number.length) { var y = number.length; str += 'point '; for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' '; } str = str.replace(/\number+/g, ' '); return str.trim() + ".";  
  
    } 

});