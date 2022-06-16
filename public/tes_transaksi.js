$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.tanggal').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
});
$(document).ready(function(){
    tampilPenjualan();
    $('.smpnbrg').click(function(){
        $("#smpnbrg").attr("disabled", true);
        var form = document.fibrg;
        var dataString = $(form).serialize();
        var a = document.getElementById("kdbrg").value;
        var b = document.getElementById("nmbrg").value;
        var c = document.getElementById("hrbrg").value;
        if (a=="") {
            $("#erbrg").html('Kode Harus Diisi');
            $("#smpnbrg").attr("disabled", false);
        }else if (b=="") {
            $("#erbrg").html('Nama Harus Diisi');
            $("#smpnbrg").attr("disabled", false);
        }else if (c=="") {
            $("#erbrg").html('Harga Harus Diisi');
            $("#smpnbrg").attr("disabled", false);
        }else{
            $.ajax({
                url: '/mbrg/ibrg',
                type: 'post',
                data: dataString,
                success: function(data){
                    if (data.info == 0) {
                        location.reload();
                    } else {
                        $("#erbrg").html('Data Sudah Ada');
                    $("#smpnbrg").attr("disabled", false);
                    }
                }
            });
        }
    });
    $('.smpncst').click(function(){
        $("#smpncst").attr("disabled", true);
        var form = document.ficst;
        var dataString = $(form).serialize();
        var a = document.getElementById("kdcst").value;
        var b = document.getElementById("nmcst").value;
        var c = document.getElementById("tlcst").value;
        if (a=="") {
            $("#ercst").html('Kode Harus Diisi');
            $("#smpncst").attr("disabled", false);
        }else if (b=="") {
            $("#ercst").html('Nama Harus Diisi');
            $("#smpncst").attr("disabled", false);
        }else if (c=="") {
            $("#ercst").html('Telepon Harus Diisi');
            $("#smpncst").attr("disabled", false);
        }else{
            $.ajax({
                url: '/mcst/icst',
                type: 'post',
                data: dataString,
                success: function(data){
                    if (data.info == 0) {
                        location.reload();
                    } else {
                        $("#ercst").html('Data Sudah Ada');
                        $("#smpncst").attr("disabled", false);
                    }
                }
            });
        }
    });
    function tampilPenjualan(){
        $.ajax({
            type: 'GET',
            url: '/tpnj/dtpnj',
            async: true,
            dataType:'json',
            success : function(data){
                var html = '';
                var i;
                var stpnjdb = [];
                for(i=0; i<data.length; i++){
                    
                    var no = i+1;
                    var hrgbndpnjrp = data[i].harga_bandrol;
                    var numstrpnjhrgbnd = hrgbndpnjrp.toString(), splpnjhrgbnd = numstrpnjhrgbnd.split(','), sspnjhrgbnd = splpnjhrgbnd[0].length % 3, rpnjhrgbnd = splpnjhrgbnd[0].substr(0, sspnjhrgbnd), rbpnjhrgbnd = splpnjhrgbnd[0].substr(sspnjhrgbnd).match(/\d{1,3}/g);
                    if (rbpnjhrgbnd) {
                        sprpnjhrgbnd = sspnjhrgbnd ? ',' : '';
                        rpnjhrgbnd += sprpnjhrgbnd + rbpnjhrgbnd.join(',');
                    }
                    rpnjhrgbnd = splpnjhrgbnd[1] != undefined ? rpnjhrgbnd + ',' + splpnjhrgbnd[1] : rpnjhrgbnd;
                    var hrgpnjrp = data[i].harga_bandrol;
                    var numstrhpnj = hrgpnjrp.toString(), sisahpnj = numstrhpnj.length % 3, rupiahpnj = numstrhpnj.substr(0, sisahpnj), ribuanhpnj = numstrhpnj.substr(sisahpnj).match(/\d{3}/g);
                    if (ribuanhpnj) {
                        separatorhpnj = sisahpnj ? '.' : '';
                        rupiahpnj += separatorhpnj + ribuanhpnj.join('.');
                    }
                    var hrgdispnjrp = data[i].harga_diskon;
                    var numstrpnjhrgdis = hrgdispnjrp.toString(), splpnjhrgdis = numstrpnjhrgdis.split(','), sspnjhrgdis = splpnjhrgdis[0].length % 3, rpnjhrgdis = splpnjhrgdis[0].substr(0, sspnjhrgdis), rbpnjhrgdis = splpnjhrgdis[0].substr(sspnjhrgdis).match(/\d{1,3}/g);
                    if (rbpnjhrgdis) {
                        sprpnjhrgdis = sspnjhrgdis ? ',' : '';
                        rpnjhrgdis += sprpnjhrgdis + rbpnjhrgdis.join(',');
                    }
                    rpnjhrgdis = splpnjhrgdis[1] != undefined ? rpnjhrgdis + ',' + splpnjhrgdis[1] : rpnjhrgdis;
                    var hrgpnjdisrp = data[i].harga_diskon;
                    var numstrhpnjdis = hrgpnjdisrp.toString(), sisahpnjdis = numstrhpnjdis.length % 3, rupiahpnjdis = numstrhpnjdis.substr(0, sisahpnjdis), ribuanhpnjdis = numstrhpnjdis.substr(sisahpnjdis).match(/\d{3}/g);
                    if (ribuanhpnjdis) {
                        separatorhpnjdis = sisahpnjdis ? '.' : '';
                        rupiahpnjdis += separatorhpnjdis + ribuanhpnjdis.join('.');
                    }
                    var dnpnjrp = data[i].diskon_nilai;
                    var nsdnpnjrp = dnpnjrp.toString(), spldnpnjrp = nsdnpnjrp.split(','), ssdnpnjrp = spldnpnjrp[0].length % 3, rpdnpnjrp = spldnpnjrp[0].substr(0, ssdnpnjrp), rbdnpnjrp = spldnpnjrp[0].substr(ssdnpnjrp).match(/\d{1,3}/g);
                    if (rbdnpnjrp) {
                        sprdnpnjrp = ssdnpnjrp ? ',' : '';
                        rpdnpnjrp += sprdnpnjrp + rbdnpnjrp.join(',');
                    }
                    rpdnpnjrp = spldnpnjrp[1] != undefined ? rpdnpnjrp + ',' + spldnpnjrp[1] : rpdnpnjrp;
                    var ttpnjrp = data[i].total;
                    var nsttpnjrp = ttpnjrp.toString(), splttpnjrp = nsttpnjrp.split(','), ssttpnjrp = splttpnjrp[0].length % 3, rpttpnjrp = splttpnjrp[0].substr(0, ssttpnjrp), rbttpnjrp = splttpnjrp[0].substr(ssttpnjrp).match(/\d{1,3}/g);
                    if (rbttpnjrp) {
                        sprttpnjrp = ssttpnjrp ? ',' : '';
                        rpttpnjrp += sprttpnjrp + rbttpnjrp.join(',');
                    }
                    rpttpnjrp = splttpnjrp[1] != undefined ? rpttpnjrp + ',' + splttpnjrp[1] : rpttpnjrp;
                    var ttldb = data[i].total.replace(/[^,\d]/g, '').toString();
                    stpnjdb.push(parseInt(ttpnjrp));
                    html += '<tr>'+
                        '<td style="text-align:center"><a href="#" class="ddtpnj" data-id="/tpnj/dpnj/'+data[i].id+'"><span class="fa fa-trash"></span></a></td>'+
                        '<td style="text-align: center"><input type="hidden" id="ipnj" class="ipnj'+i+'" value="'+data[i].id+'">'+no+'</td>'+
                        '<td>'+data[i].kode+'</td>'+
                        '<td>'+data[i].nama+'</td>'+
                        '<td style="text-align: center"><input type="text" class="form-control qpnj'+i+'" id="qpnj" name="qpnj[]" data-input-id="'+i+'" onkeyup="kqpnj(this)" onclick="snqpnj(this)" value="'+data[i].qty+'" autocomplete="off"></td>'+
                        '<td style="text-align: right"><b><span>'+rpnjhrgbnd+'</span></b><input type="hidden" class="form-control hpnj'+i+'" id="hpnj" name="hpnj[]" data-input-id="'+i+'" value="'+rupiahpnj+'"></td>'+
                        '<td style="text-align: center"><input type="text" class="form-control dppnj'+i+'" id="dppnj" name="dppnj[]" data-input-id="'+i+'" onkeyup="kddpnj(this)" onclick="sndppnj(this)" value="'+data[i].diskon_pct+'" autocomplete="off"></td>'+
                        '<td style="text-align: center"><b><span class="sdnpnj'+i+'">'+rpdnpnjrp+'</span></b><input type="hidden" class="form-control dnpnj'+i+'" id="dnpnj" name="dnpnj[]" data-input-id="'+i+'" onkeyup="getdpnj(this)" onclick="setnoldpnj(this)" value="'+data[i].diskon_nilai+'" autocomplete="off"></td>'+
                        '<td style="text-align: right"><b><span class="shdpnj'+i+'">'+rpnjhrgdis+'</span></b><input type="hidden" class="form-control hdpnj'+i+'" id="hdpnj" name="hdpnj[]" data-input-id="'+i+'" value="'+rupiahpnjdis+'"></td>'+
                        '<td style="text-align:center"><b><span class="stpnj'+i+'">'+rpttpnjrp+'</span></b><input type="hidden" id="tpnj" class="tpnj'+i+'" value="'+data[i].total+'"></td>'+                  
                    '</tr>';
                }
                var sumstpnjdb = stpnjdb.reduce(function(stpnjdb, b){return stpnjdb + b;}, 0);
                var nstpnjrp = sumstpnjdb.toString(), sstpnjrp = nstpnjrp.length % 3, rptpnjrp = nstpnjrp.substr(0, sstpnjrp), rbtpnjrp = nstpnjrp.substr(sstpnjrp).match(/\d{3}/g);
                    if (rbtpnjrp) {
                        sprtpnjrp = sstpnjrp ? ',' : '';
                        rptpnjrp += sprtpnjrp + rbtpnjrp.join(',');
                    }
                $('#tdtpnj').html(html);
                $('.hstpnj').val(sumstpnjdb);
                $('.stpnj').val(rptpnjrp);
                $('.ttlbyrpnj').val(rptpnjrp);
            }
        });
    }
    $('.pnjbrg').change(function(){
        tampilPenjualan();
        $(this).val('');
    });
    $(function(){
        $(document).on('click','.ddtpnj',function(e){
            e.preventDefault();
            var ud = $(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: ud,
                data: {},
                success: function() {
                    tampilPenjualan();
                }
            });
        });
    });
    $('.btnsmpnpnj').click(function(){
        $("#btnsmpnpnj").attr("disabled", true);
        var vkdpnj = $('.kdpnj').val();
        var vtglpnj = $('.tglpnj').val();
        var vpnjidcst = $('.pnjidcst').val();
        var vstpnj = $('.stpnj').val();
        var vdispnj = $('.dispnj').val();
        var vokrpnj = $('.okrpnj').val();
        var vttlbyrpnj = $('.ttlbyrpnj').val();
        var a = document.getElementById("tglpnj").value;
        var b = document.getElementById("pnjidcst").value;
        if (a=="") {
            $(".ertpnj").html('Tanggal Transaksi Harus Diisi');
            $("#btnsmpnpnj").attr("disabled", false);
        }else if(b==""){
            $(".ertpnj").html('Pilih Customer Terlebih Dahulu');
            $("#btnsmpnpnj").attr("disabled", false);
        }else{
            $.ajax({
                url: '/tpnj/ipnj',
                type: 'post',
                data: {kd: vkdpnj, tgl: vtglpnj, idcst: vpnjidcst, sub: vstpnj, dis: vdispnj, okr: vokrpnj, ttl: vttlbyrpnj},
                success: function(data){
                    location.reload();
                }
            });
        }
    });
    var table = $('#tblttlpnj').DataTable({
        "bPaginate": false,
        ordering: false,
        orderCellsTop: true,
        fixedHeader: true,
        "footerCallback": function ( row, data, start, end, display ) {
            var numformat = $.fn.dataTable.render.number( ',', '.', 0, '' ).display;
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };
            total = api.column( 8 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
            pageTotal = api.column( 8, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
            $( api.column( 8 ).footer() ).html(
                numformat(pageTotal)
            );
        }
    });
});
function formatRupiah(angkax, prefixx){
    var number_string3 = angkax.replace(/[^,\d]/g, '').toString(),
    split3 = number_string3.split(','),
    sisa3 = split3[0].length % 3,
    rupiah3 = split3[0].substr(0, sisa3),
    ribuan3 = split3[0].substr(sisa3).match(/\d{3}/gi);
    if(ribuan3){
        separator3 = sisa3 ? '.' : '';
        rupiah3 += separator3 + ribuan3.join('.');
    }
    rupiah3 = split3[1] != undefined ? rupiah3 + ',' + split3[1] : rupiah3;
    return prefixx == undefined ? rupiah3 : (rupiah3 ? rupiah3 : '');
}
function getHrgBrg(element){
    const val = element.value;
    $('.hrbrg').val(formatRupiah(val));
}
function getUHrgBrg(element){
    const val = element.value;
    $('.uhrbrg').val(formatRupiah(val));
}
function snqpnj(element){
    const inputId = element.dataset.inputId;
    const val = element.value;
    if (val==0) {
        var h = '';
    }else{
        var h = val;
    }
    $('.qpnj'+inputId).val(h);
}
function kqpnj(element){
    const inputId = element.dataset.inputId;
    const val = element.value;
    var hdpnj = $('.hdpnj'+inputId).val();
    var hdpnj2 = hdpnj.replace(/[^,\d]/g, '').toString();
    var ipnj = $('.ipnj'+inputId).val();
    if (val=='') {
        var qf = 0;
    }else{
        var qf = val;
    }
    if (hdpnj2=='') {
        var hf = 0;
    }else{
        var hf = hdpnj2;
    }
    var jml = parseInt(qf) * parseInt(hf);
    var hrg = jml.toFixed(0);
    var numstr = hrg.toString(), sisa = numstr.length % 3, rupiah = numstr.substr(0, sisa), ribuan = numstr.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? ',' : '';
        rupiah += separator + ribuan.join(',');
    }
    $('.stpnj'+inputId).html(rupiah+',00');
    $('.tpnj'+inputId).val(hrg);
    $.ajax({
        url: '/tpnj/qtypnj',
        type: 'post',
        data: {id:ipnj, qty:qf, ttl:hrg},
        success: function(data){

        }
    })
    var sum=0;
    $("#tblpnj tr").each(function(){
        $(this).find('input[id="tpnj"]').each(function(){
            if (!isNaN(this.value)&&this.value.length!=0) {
                sum+=parseInt(this.value);
            }
        });
    });
    var st = sum.toFixed(0);
    var numstr2 = st.toString(), sisa2 = numstr2.length % 3, rupiah2 = numstr2.substr(0, sisa2), ribuan2 = numstr2.substr(sisa2).match(/\d{3}/g);
    if (ribuan2) {
        separator2 = sisa2 ? ',' : '';
        rupiah2 += separator2 + ribuan2.join(',');
    }
    $('.stpnj').val(rupiah2);
    $('.hstpnj').val(st);
    $('.ttlbyrpnj').val(rupiah2);
}
function sndppnj(element){
    const inputId = element.dataset.inputId;
    const val = element.value;
    if (val==0) {
        var h = '';
    }else{
        var h = val;
    }
    $('.dppnj'+inputId).val(h);
}
function kddpnj(element){
    const inputId = element.dataset.inputId;
    const val = element.value;
    var hpnj = $('.hpnj'+inputId).val();
    var hpnj2 = hpnj.replace(/[^,\d]/g, '').toString();
    var qpnj = $('.qpnj'+inputId).val();
    var ipnj = $('.ipnj'+inputId).val();
    if (hpnj2=='') {
        var hf = 0;
    }else{
        var hf = hpnj2;
    }
    if (val=='') {
        var df = 0;
    }else{
        var df = val;
    }
    if (qpnj=='') {
        var qf = 0;
    }else{
        var qf = qpnj;
    }
    var dis = parseInt(df)/100;
    var dis2 = parseInt(hf) * dis;
    var dis3 = parseInt(hf) - dis2;
    var ttl = parseInt(qf) * dis3;
    var hrg = dis2.toFixed(0);
    var numstr = hrg.toString(), sisa = numstr.length % 3, rupiah = numstr.substr(0, sisa), ribuan = numstr.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? ',' : '';
        rupiah += separator + ribuan.join(',');
    }
    $('.sdnpnj'+inputId).html(rupiah+',00');
    $('.dnpnj'+inputId).val(hrg);
    var hrg2 = dis3.toFixed(0);
    var numstr2 = hrg2.toString(), sisa2 = numstr2.length % 3, rupiah2 = numstr2.substr(0, sisa2), ribuan2 = numstr2.substr(sisa2).match(/\d{3}/g);
    if (ribuan2) {
        separator2 = sisa2 ? ',' : '';
        rupiah2 += separator2 + ribuan2.join(',');
    }
    $('.shdpnj'+inputId).html(rupiah2+',00');
    $('.hdpnj'+inputId).val(hrg2);
    var ttl2 = ttl.toFixed(0);
    var numstr3 = ttl2.toString(), sisa3 = numstr3.length % 3, rupiah3 = numstr3.substr(0, sisa3), ribuan3 = numstr3.substr(sisa3).match(/\d{3}/g);
    if (ribuan3) {
        separator3 = sisa3 ? ',' : '';
        rupiah3 += separator3 + ribuan3.join(',');
    }
    $('.stpnj'+inputId).html(rupiah3+',00');
    $('.tpnj'+inputId).val(ttl2);
    $.ajax({
        url: '/tpnj/dispnj',
        type: 'post',
        data: {id:ipnj, dp:df, dn:hrg, hd:hrg2, ttl:ttl2},
        success: function(data){

        }
    })
    var sum=0;
    $("#tblpnj tr").each(function(){
        $(this).find('input[id="tpnj"]').each(function(){
            if (!isNaN(this.value)&&this.value.length!=0) {
                sum+=parseInt(this.value);
            }
        });
    });
    var st = sum.toFixed(0);
    var numstr4 = st.toString(), sisa4 = numstr4.length % 3, rupiah4 = numstr4.substr(0, sisa4), ribuan4 = numstr4.substr(sisa4).match(/\d{3}/g);
    if (ribuan4) {
        separator4 = sisa4 ? ',' : '';
        rupiah4 += separator4 + ribuan4.join(',');
    }
    $('.stpnj').val(rupiah4);
    $('.hstpnj').val(st);
    $('.ttlbyrpnj').val(rupiah4);
}
function getdisPnj(element){
    const val = element.value;
    $('.dispnj').val(formatRupiah(val));
    var dis = val.replace(/[^,\d]/g, '').toString();
    var st = $('.hstpnj').val();
    var st2 = st.replace(/[^,\d]/g, '').toString();
    var ok = $('.okrpnj').val();
    var ok2 = ok.replace(/[^,\d]/g, '').toString();
    if (st2=='') {
        var hf = 0;
    }else{
        var hf = st2;
    }
    if (ok2=='') {
        var okf = 0;
    }else{
        var okf = ok2;
    }
    if (dis=='') {
        var df = 0;
    }else{
        var df = dis;
    }
    var ttl = parseInt(hf) - parseInt(df) - parseInt(okf);
    var numstr = ttl.toString(), sisa = numstr.length % 3, rupiah = numstr.substr(0, sisa), ribuan = numstr.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? ',' : '';
        rupiah += separator + ribuan.join(',');
    }
    $('.ttlbyrpnj').val(rupiah);
}
function getokrPnj(element){
    const val = element.value;
    $('.okrpnj').val(formatRupiah(val));
    var okr = val.replace(/[^,\d]/g, '').toString();
    var st = $('.hstpnj').val();
    var st2 = st.replace(/[^,\d]/g, '').toString();
    var dis = $('.dispnj').val();
    var dis2 = dis.replace(/[^,\d]/g, '').toString();
    if (st2=='') {
        var hf = 0;
    }else{
        var hf = st2;
    }
    if (dis2=='') {
        var df = 0;
    }else{
        var df = dis2;
    }
    if (okr=='') {
        var okf = 0;
    }else{
        var okf = okr;
    }
    var ttl = parseInt(hf) - parseInt(okf) - parseInt(df);
    var numstr = ttl.toString(), sisa = numstr.length % 3, rupiah = numstr.substr(0, sisa), ribuan = numstr.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? ',' : '';
        rupiah += separator + ribuan.join(',');
    }
    $('.ttlbyrpnj').val(rupiah);
}