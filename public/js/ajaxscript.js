/**
 * Created by ArsipTI.com on 01/12/2016.
 */
var url = "http://localhost:8000/";

$('button#delete').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Anda yakin akan menghapus "+nama+" dari "+tabel+"?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    },
    function (isConfirm) {
        if(isConfirm) form.submit();
    });
  });

//MODAL ADMIN GRUP
//modal add user
$('#addUser').on('show.bs.modal',function(event){
  var modal= $(this);
  //JABATAN
  $.ajax({
    url:'/addUser/',
    type:"GET",
    dataType:"json",
    success:function(data){
      $('#pilihjabatan').empty();
      i=0;
      var show='<option value="" disabled selected>--Pilih Jabatan--</option>';
      if($.isEmptyObject(data)){
        $('#pilihjabatan').empty();
        $('#pilihjabatan').append(show);
      }
      else{
        $.each(data,function(){
          $('#pilihjabatan').empty();
          show+='<option value="'+data[i].id_jabatan+'">'+data[i].nama_jabatan+'</option>';
          $('#pilihjabatan').append(show);
          i+=1;
        });
      }
    }
  });
  //KANTOR
  $.ajax({
      url:'/getAllTipe/',
      type:"GET",
      dataType:"json",
      success:function(data){
          modal.find('#tipe').empty();
          i=0;
          var show='<option value="" disabled selected>--Pilih tipe kantor--</option>';
          if($.isEmptyObject(data)){
              modal.find('#tipe').empty();
              modal.find('#tipe').append(show);
          }
          else{
              $.each(data,function(){
                  modal.find('#tipe').empty();
                  show+='<option value="'+data[i].id_tipe+'">'+data[i].tipe_kantor+'</option>';
                  modal.find('#tipe').append(show);
                  i+=1;
              });
          }
      }
  });
  modal.find('#tipe').on('change', function() {
    var selectedtipe = $(this).val();
    $.ajax({
     url: '/kantorAddUser/'+selectedtipe,
     type: "GET",
     dataType: "json",
     success:function(data) {
         modal.find('#pilihkantor').empty();
         i=0;
         var show='<option value="" disabled selected>--Pilih Kantor--</option>';
         if($.isEmptyObject(data)){
             modal.find('#pilihkantor').empty();
             modal.find('#pilihkantor').append(show);
         }
         else{
           $.each(data, function() {
             modal.find('#pilihkantor').empty();
             show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
             modal.find('#pilihkantor').append(show);
             i+=1;
           });
           modal.find('#pilihkantor').selectpicker('render').selectpicker('refresh');
        }
      }
    });
  });
});
//modal edit user
$('#editUser').on('show.bs.modal',function(event){
  var link=$(event.relatedTarget);
  var id=link.data('id');
  var nip=link.data('nip');
  var nama=link.data('nama');
  var kantor=link.data('kantor');
  var tipe=link.data('tipekantor');
  var jabatan=link.data('jabatan');
  var uname=link.data('username');
  var modal= $(this);
  modal.find('#id_user').val(id);
  modal.find('#NIP').val(nip);
  modal.find('#nama').val(nama);
  modal.find('#username').val(uname);
  //JABATAN
  $.ajax({
    url:'/addUser/',
    type:"GET",
    dataType:"json",
    success:function(data){ 
      modal.find('#pilihjabatan').empty();
      i=0;
      var cek='';
      if($.isEmptyObject(jabatan)){
        cek=' selected';
      }
      var show='<option value="" disabled'+cek+'>--Pilih Jabatan--</option>';
      if($.isEmptyObject(data)){
        modal.find('#pilihjabatan').empty();
        modal.find('#pilihjabatan').append(show);
      }
      else{
        $.each(data,function(){
          modal.find('#pilihjabatan').empty();
          if(data[i].id_jabatan==jabatan){
            show+='<option value="'+data[i].id_jabatan+'" selected>'+data[i].nama_jabatan+'</option>';
          }
          else{
            show+='<option value="'+data[i].id_jabatan+'">'+data[i].nama_jabatan+'</option>';
          }
          modal.find('#pilihjabatan').append(show);
          i+=1;
        });
      }
    }
  });


  //KANTOR
  $.ajax({
    url:'/getAllTipe/',
    type:"GET",
    dataType:"json",
    success:function(data){
        modal.find('#tipe').empty();
        i=0;
        var show='<option value="" disabled>--Pilih tipe kantor--</option>';
        if($.isEmptyObject(data)){
          show='<option value="" disabled selected>--Pilih tipe kantor--</option>';
          modal.find('#tipe').empty();
          modal.find('#tipe').append(show);
        }
        else{
            $.each(data,function(){
                modal.find('#tipe').empty();
                if(data[i].id_tipe==tipe){
                  show+='<option value="'+data[i].id_tipe+'" selected>'+data[i].tipe_kantor+'</option>';
                }
                else{
                  show+='<option value="'+data[i].id_tipe+'">'+data[i].tipe_kantor+'</option>';
                }
                modal.find('#tipe').append(show);
                i+=1;
            });
        }
    }
  });
  //data kantor saat ini
  $.ajax({
     url: '/kantorAddUser/'+tipe,
     type: "GET",
     dataType: "json",
     success:function(data) {
         modal.find('#pilihkantor').empty();
         i=0;
         var cek='selected';
         var show='<option value="" disabled>--Pilih Kantor--</option>';
         if($.isEmptyObject(data)){
            var out='<option value="" disabled selected>--Pilih Kantor--</option>';
            modal.find('#pilihkantor').empty();
            modal.find('#pilihkantor').append(out);
         }
         else{
           $.each(data, function() {
             modal.find('#pilihkantor').empty();
             if(data[i].id_kantor == kantor){
  
                show+='<option value="'+ data[i].id_kantor +'" selected>'+ data[i].nama_kantor +'</option>'; 
             }
             else{
                show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
             }
             modal.find('#pilihkantor').append(show);
             i+=1;
           });
           modal.find('#pilihkantor').selectpicker('render').selectpicker('refresh');
        }
    }
  });

 //select kantor
  modal.find('#tipe').on('change', function() {
    var selectedtipe = $(this).val();
    $.ajax({
     url: '/kantorAddUser/'+selectedtipe,
     type: "GET",
     dataType: "json",
     success:function(data) {
         modal.find('#pilihkantor').empty();
         i=0;
         var show='<option value="" disabled selected>--Pilih Kantor--</option>';
         if($.isEmptyObject(data)){
             modal.find('#pilihkantor').empty();
             modal.find('#pilihkantor').append(show);
         }
         else{
           $.each(data, function() {
             modal.find('#pilihkantor').empty();
             show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
             modal.find('#pilihkantor').append(show);
             i+=1;
           });
           modal.find('#pilihkantor').selectpicker('render').selectpicker('refresh');
        }
      }
    });
  });
});

//modal add admin, show list jabatan
$('#addAdmin').on('show.bs.modal',function(event){
  var link = $(event.relatedTarget);
  var id = link.data('value');
  var modal = $(this);
  modal.find('#id_user').val(id);
  $.ajax({
    url:'/addAdmin/'+id,
    type:"GET",
    dataType:"json",
    success:function(data){
      $('#popup').empty();
      i=0;
      $.each(data,function(){
          var show='<div class="col-md-6"><div id="buatloop" class="form-group">';
          show+='<input name="jabatan[]" type="checkbox" id="' + data[i].id_jabatan + '" value="' + data[i].id_jabatan + '" autocomplete="off" />';
          show+='<div class="[ btn-group ]"><label for="' + data[i].id_jabatan + '" class="[ btn btn-default ]"><span class="[ glyphicon glyphicon-ok ]"></span>';
          show+='<span> </span></label><label for="' + data[i].id_jabatan + '" class="[ btn btn-default active ]">'+ data[i].nama_jabatan;
          show+='</label></div></div>';
          $('#popup').append(show);
          i+=1;
      });
    }
  });
});
//modal edit admin, show list jabatan
$('#editAdmin').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var id = link.data('value');
    var modal = $(this);
    modal.find('#id_user').val(id);
    $.ajax({
      url:'/editAdmin/'+id,
      type:"GET",
      dataType:"json",
      success:function(data){
        $('#listjabatan').empty();
        i=0;
        $.each(data.jabatan,function(){
          if(data.status[i]==1){
              var cek='checked="checked"/>';
          }
          else{
              var cek='/>';
          }
          var show='<div class="col-md-6"><div id="buatloop" class="form-group">';
          show+='<input name="jabatan[]" type="checkbox" id="' + data.jabatan[i].id_jabatan + '" value="' + data.jabatan[i].id_jabatan + '" autocomplete="off"'+cek;
          show+='<div class="[ btn-group ]"><label for="' + data.jabatan[i].id_jabatan + '" class="[ btn btn-default ]"><span class="[ glyphicon glyphicon-ok ]"></span>';
          show+='<span> </span></label><label for="' + data.jabatan[i].id_jabatan + '" class="[ btn btn-default active ]">'+ data.jabatan[i].nama_jabatan;
          show+='</label></div></div>';
          $('#listjabatan').append(show);
          i+=1;
        });
      }
    });
});

//modal edit jabatan
$('#editJabatan').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var nama = link.data('value');
    var id = link.data('id');
    var modal = $(this);
    modal.find('#jabatan').val(nama);
    modal.find('#id_jabatan').val(id);
});

//add dan edit operator kantor
$('#addOK').on('show.bs.modal',function(event){
    $.ajax({
        url:'/getKantor/',
        type:"GET",
        dataType:"json",
        success:function(data){
          $('#listkantors').empty();
          i=0;
          var show='<option value="" disabled selected>Pilih Kantor</option>';
          if($.isEmptyObject(data)){
            $('#listkantors').empty();
            $('#listkantors').append(show);
          }
          else{
            $.each(data,function(){
              $('#listkantors').empty();
              show+='<option value="'+data[i].id_kantor+'">'+data[i].nama_kantor+'</option>';
              $('#listkantors').append(show);
              i+=1;
            });
          }
        }
    });
});
$('#editOK').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var username = link.data('value');
    var id = link.data('id');
    var modal = $(this);
    modal.find('#id_sa').val(id);
    modal.find('#username').val(username);
    $.ajax({
        url:'/getEditKantor/'+username,
        type:"GET",
        dataType:"json",
        success:function(data){
            $('#listkantor').empty();
            i=0;
            var show='<option value="'+data.kantor.id_kantor+'" selected>'+data.kantor.nama_kantor+'</option>';
            $.each(data.kantors,function(){
                show+='<option value="'+data.kantors[i].id_kantor+'">'+data.kantors[i].nama_kantor+'</option>';
                $('#listkantor').append(show);
                i+=1;
            });
        }
    });
});

//rekap jabatan
$(document).ready(function() {
  var modal = $(this);
  //list jabatan
  $.ajax({
    url:'/addUser/',
    type:"GET",
    dataType:"json",
    success:function(data){
      modal.find('#jabatan').empty();
      i=0;
      var show='<option value="" disabled selected>--Pilih Jabatan--</option>';
      if($.isEmptyObject(data)){
        modal.find('#jabatan').empty();
        modal.find('#jabatan').append(show);
      }
      else{
        $.each(data,function(){
          modal.find('#jabatan').empty();
          show+='<option value="'+data[i].id_jabatan+'">'+data[i].nama_jabatan+'</option>';
          modal.find('#jabatan').append(show);
          i+=1;
        });
      }
      modal.find('#jabatan').selectpicker('render').selectpicker('refresh');
    }
  });
  modal.find('#jabatan').on('change',function(){
        modal.find('#panjang').prop('checked',false);
        modal.find('#pendek').prop('checked',false);
        modal.find('#materitest').empty();
        var show='<option value="" disabled selected>-- Pilih Materi --</option>';
        modal.find('#materitest').append(show);
        modal.find('#materitest').selectpicker('render').selectpicker('refresh');
        
  });
  //list
   modal.find('input[type="radio"]').on('change',function(){
    var selectedtipe = $('input[type="radio"]:checked').val();
    var jabatan = modal.find('#jabatan').val();
    $.ajax({
     url: '/getMateri/'+jabatan+'/'+selectedtipe,
     type: "GET",
     dataType: "json",
     success:function(data) {
         i=0;
         modal.find('#materitest').empty();
         var show='<option value="" disabled selected>-- Pilih Materi --</option>';
         if($.isEmptyObject(data.materi)){
             modal.find('#materitest').empty();
             modal.find('#materitest').append(show);
         }
         else{
           $.each(data.materi, function() {
             modal.find('#materitest').empty();
             if(selectedtipe==0){
              show+='<optgroup label="'+data.materi[i].nama_test+'">';
             }
             j=0;
             $.each(data.test,function(){
              if(data.test[j].id_mat==data.materi[i].id_mat){
                show+='<option value="'+ data.test[j].id_test +'">'+ data.test[j].nama +'</option>';
              }
              j+=1;
             });
             if(selectedtipe==0){
              show+="</optgroup>";
             }
             modal.find('#materitest').append(show);
             i+=1;
           });
        }
        modal.find('#materitest').selectpicker('render').selectpicker('refresh');
      }
    });
  });

   modal.find('#filterbtn').click(function(){
    var hashids = new Hashids("ganteng",20);
    var selected= hashids.encode(modal.find('#materitest').val());
    var status = modal.find('#status').val();
    if(!$.isEmptyObject(selected) && status=='chart'){
      window.location.href="/admin/chart/"+selected;
    }else{
      window.location.href="/admin/rekap/tabel/"+selected;
    }
  });
});
   

//rekap filtering
$(document).ready(function() {
  var modal = $(this);
  //radio tipe kantor
  modal.find('#radiogrup').ready(function(){
    $.ajax({
      url:'/filterTipe',
      type:'GET',
      dataType:"json",
      success:function(data){
        i=0;
        j=0;
        modal.find('#radiogrup').empty();
        var show='<label><input type="radio" name="Radio" value="all"> Tanpa Filter</label> &nbsp;';
        if($.isEmptyObject(data.tipe)){
          modal.find('#radiogrup').empty();
          modal.find('#radiogrup').append(show);
        }
        else{
          $.each(data.tipe,function(){
            if(data.tipe[i].level<data.max){
              show+='<label><input type="radio" name="Radio" value="'+data.tipe[i].id_tipe+'"> '+data.tipe[i].tipe_kantor+' </label> &nbsp;'; 
            }
            else{
              if(j==0){
                show+='<label><input type="radio" name="Radio" value="'+data.tipe[i].id_tipe+'"> Unit Kerja</label> ';
                j+=1;
              }
            }
            modal.find('#radiogrup').empty();
            modal.find('#radiogrup').append(show);
            i+=1;
          })
        }    
      }
    });
  });

  //list kantor
   modal.find('#radiogrup').change(function(){
    var selectedtipe = modal.find('input[type="radio"]:checked').val();
    if(selectedtipe=="all"){
      modal.find('#box').hide();
    }else{
      modal.find('#box').show();
    }
    $.ajax({
     url: '/filterKantor/'+selectedtipe,
     type: "GET",
     dataType: "json",
     success:function(data) {
         i=0;
         modal.find('#kantor').empty();
         var show='<option value="" disabled selected>-- Pilih Kantor --</option>';
         if($.isEmptyObject(data)){
             modal.find('#kantor').empty();
             modal.find('#kantor').append(show);
         }
         else{
           $.each(data, function() {
            show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
            modal.find('#kantor').empty();
            modal.find('#kantor').append(show);
            i+=1;
          });
        }
        modal.find('#kantor').selectpicker('render').selectpicker('refresh');
      }
    });
  });
  //  modal.find('#filterbtn').click(function(){
  //   var hashids = new Hashids("ganteng",20);
  //   var selected= hashids.encode(modal.find('#materitest').val());
  //   console.log(selected);
  //   if(!$.isEmptyObject(selected)){
  //     window.location.href="/admin/rekap/tabel/"+selected;
  //   }
  // });
});

//MODAL ULTRAADMIN
//show add superadmin
$('#addSuperadmin').on('show.bs.modal',function(event){
  var modal=$(this);
  $.ajax({
    url:'/getGroupUa/',
    type:"GET",
    dataType:"json",
    success:function(data){
        $('#selectgroups').empty();
        i=0;
        var show='<option value="" disabled selected>-- Pilih Grup --</option>';
        if($.isEmptyObject(data)){
            modal.find('#selectgroups').empty();
            modal.find('#selectgroups').append(show);
        }
        else{
            $.each(data,function(){
                modal.find('#selectgroups').empty();
                show+='<option value="'+data[i].id_grup+'">'+data[i].nama_grup+'</option>';
                modal.find('#selectgroups').append(show);
                i+=1;
            });
        }
        modal.find('#selectgroups').selectpicker('render').selectpicker('refresh');
    }
  });
});
//show edit superadmin
$('#editSuperadmin').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var uname = link.data('value');
    var id = link.data('id');
    var email = link.data('email');
    var modal = $(this);
    modal.find('#id_sa').val(id);
    modal.find('#username2').val(uname);
    modal.find('#email').val(email);
    $.ajax({
        url:'/getEditGroupUa/'+uname,
        type:"GET",
        dataType:"json",
        success:function(data){
            modal.find('#selectgroup').empty();
            i=0;
            var show='<option val="" disabled>-- Pilih Grup --</option>';
            show+='<option value="'+data.grup.id_grup+'" selected>'+data.grup.nama_grup+'</option>';
            if($.isEmptyObject(data.groups)){
                modal.find('#selectgroup').empty();
                modal.find('#selectgroup').append(show);
            }
            else{
                $.each(data.groups,function(){
                    modal.find('#selectgroup').empty();
                    show+='<option value="'+data.groups[i].id_grup+'">'+data.groups[i].nama_grup+'</option>';
                    modal.find('#selectgroup').append(show);
                    i+=1;
                });
            }
            modal.find('#selectgroup').selectpicker('render').selectpicker('refresh');
        }
    });
});

//modal edit group
$('#editGroup').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var id = link.data('id');
    var kode = link.data('kode');
    var nama = link.data('name');
    var modal = $(this);
    modal.find('#id').val(id);
    modal.find('#kode2').val(kode);
    modal.find('#nama').val(nama);
});

//modal add tipe kantor
$('#addTipe').on('show.bs.modal',function(event){
  var modal=$(this);
    $.ajax({
        url:'/getAllGroup/',
        type:"GET",
        dataType:"json",
        success:function(data){

          modal.find('#listgrup').empty();
          i=0;
          var show='<option value="" disabled>-- Pilih Grup --</option>';
          if($.isEmptyObject(data)){
            show='<option value="" disabled selected>-- Pilih Grup --</option>';
            modal.find('#listgrup').empty();
            modal.find('#listgrup').append(show);
          }
          else{
            $.each(data,function(){
              modal.find('#listgrup').empty();
              if(data.kode_grup=="ALL"){
                show+='<option value="'+data[i].id_grup+'" selected>'+data[i].kode_grup+' ('+data[i].nama_grup+') </option>';
              }
              else{
                show+='<option value="'+data[i].id_grup+'">'+data[i].kode_grup+' ('+data[i].nama_grup+') </option>';
              }
              modal.find('#listgrup').append(show);
              i+=1;
            });
          }
        }
    });
});

$('#editTipe').on('show.bs.modal',function(event){
  var link = $(event.relatedTarget);
  var grup = link.data('grup');
  var tipe = link.data('tipe');
  var level = link.data('level');
  var id = link.data('id');
  var modal = $(this);
  modal.find("#tipe").val(tipe);
  modal.find('#id_tipe').val(id);
    $.ajax({
        url:'/getAllGroup/',
        type:"GET",
        dataType:"json",
        success:function(data){
          modal.find('#level').empty();
          var show='<option value="" disabled selected> -- Pilih Level -- </option>';
          i=0;
          while(i<10){
            if(level==i){
              show+='<option value="'+i+'" selected>'+i+'</option>';
            }
            else{
              show+='<option value="'+i+'">'+i+'</option>';
            }
            i+=1;
          }
          modal.find('#level').append(show);
          modal.find('#listgrup').empty();
          i=0;
          var show='<option value="" disabled>-- Pilih Grup --</option>';
          if($.isEmptyObject(data)){
            show='<option value="" disabled selected>-- Pilih Grup --</option>';
            modal.find('#listgrup').empty();
            modal.find('#listgrup').append(show);
          }
          else{
            $.each(data,function(){
              modal.find('#listgrup').empty();
              if(data[i].id_grup==grup){
                show+='<option value="'+data[i].id_grup+'" selected>'+data[i].kode_grup+' ('+data[i].nama_grup+') </option>';
              }
              else{
                show+='<option value="'+data[i].id_grup+'">'+data[i].kode_grup+' ('+data[i].nama_grup+') </option>';
              }
              modal.find('#listgrup').append(show);
              i+=1;
            });
          }
        }
    });
});
//modal add kantor
$('#addKantor').on('show.bs.modal',function(event){
    var modal = $(this);
    $.ajax({
      url:'/getTipe/',
      type:'GET',
      dataType:'json',
      success:function(data){
          modal.find('#tipe').empty();
          i=0;
          var show='<option value="" disabled selected>--Pilih tipe kantor--</option>';
          if($.isEmptyObject(data)){
              modal.find('#tipe').empty();
              modal.find('#tipe').append(show);
          }
          else{
              $.each(data,function(){
                  modal.find('#tipe').empty();
                  show+='<option value="'+data[i].id_tipe+'">'+data[i].tipe_kantor+'</option>';
                  modal.find('#tipe').append(show);
                  i+=1;
              });
          }
      }
      
  });
  modal.find('#tipe').on('change', function() {
      var selectedtipe = $(this).val();
      $.ajax({
       url:'/modaltambah/'+selectedtipe,
       type:'GET',
       dataType:'json',
       success:function(data) {
           modal.find('#superkantor').empty();
           i=0;
           var show='<option value="" disabled selected>--Pilih Kantor--</option>';
           if($.isEmptyObject(data)){
               modal.find('#superkantor').empty();
               modal.find('#superkantor').append(show);
           }
           else{
             $.each(data, function() {
               modal.find('#superkantor').empty();
               show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
               modal.find('#superkantor').append(show);
               i+=1;
             });
            modal.find('#superkantor').selectpicker('render').selectpicker('refresh');
          }
        }
      });
  });
});
//modal edit kantor
$('#editKantor').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var nama = link.data('value');
    var tipe = link.data('tipe');
    var level = link.data('level');
    var id = link.data('id');
    var modal = $(this);
    modal.find('#kantor').val(nama);
    modal.find('#id_kantor').val(id);
    //tipe kantor
    $.ajax({
      url:'/getTipe/',
      type:"GET",
      dataType:"json",
      success:function(data){
          modal.find('#tipe').empty();
          i=0;
          var show='<option value="" disabled>--Pilih tipe kantor--</option>';
          if($.isEmptyObject(data)){
            show='<option value="" disabled selected>--Pilih tipe kantor--</option>';
            modal.find('#tipe').empty();
            modal.find('#tipe').append(show);
          }
          else{
              $.each(data,function(){
                  modal.find('#tipe').empty();
                  if(data[i].id_tipe==tipe){
                    show+='<option value="'+data[i].id_tipe+'" selected>'+data[i].tipe_kantor+'</option>';
                  }
                  else{
                    show+='<option value="'+data[i].id_tipe+'">'+data[i].tipe_kantor+'</option>';
                  }
                  modal.find('#tipe').append(show);
                  i+=1;
              });
          }
      }
    });
    //data kantor saat ini
    $.ajax({
       url: '/modaledit/'+id,
       type: "GET",
       dataType: "json",
       success:function(data) {
           modal.find('#superkantor').empty();
           i=0;
           var show='<option value="" disabled>--Pilih Kantor--</option>';
           if($.isEmptyObject(data.superkantor)){
              var out='<option value="" disabled selected>--Pilih Kantor--</option>';
              modal.find('#superkantor').empty();
              modal.find('#superkantor').append(out);
           }
           else{
             $.each(data.superkantor, function() {
               modal.find('#superkantor').empty();
               if(data.superkantor[i].id_kantor == data.kantor.id_superkantor){
                  show+='<option value="'+ data.superkantor[i].id_kantor +'" selected>'+ data.superkantor[i].nama_kantor +'</option>'; 
               }else{
                  show+='<option value="'+ data.superkantor[i].id_kantor +'">'+ data.superkantor[i].nama_kantor +'</option>';
               }
               modal.find('#superkantor').append(show);
               i+=1;
             });
          }
        modal.find('#superkantor').selectpicker('render').selectpicker('refresh');   
      }
    });
    //select kantor
    modal.find('#tipe').on('change', function() {
      var selectedtipe = $(this).val();
      $.ajax({
       url: '/modaltambah/'+selectedtipe,
       type: "GET",
       dataType: "json",
       success:function(data) {
           modal.find('#superkantor').empty();
           i=0;
           var show='<option value="" disabled selected>--Pilih Kantor--</option>';
           if($.isEmptyObject(data)){
               modal.find('#superkantor').empty();
               modal.find('#superkantor').append(show);
           }
           else{
             $.each(data, function() {
               modal.find('#superkantor').empty();
               show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
               modal.find('#superkantor').append(show);
               i+=1;
             });
             modal.find('#superkantor').selectpicker('render').selectpicker('refresh');
          }
        }
      });
  });
});




//save button
/*$("#btn-save").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    e.preventDefault();
    var formData = {
        tagname: $('#tagname').val(),
        slug: $('#slug').val(),
    }
    //Jika Tombol Simpan ditekan/diklik [tambah=POST], [perbaharui=PUT]
    var state = $('#btn-save').val();
    var type = "POST"; //membuat data baru
    var tag_id = $('#tag_id').val();;
    var my_url = url;
    if (state == "update"){
        type = "PUT"; //memperbaharui data yang sudah ada
        my_url += '/' + tag_id;
    }
    console.log(formData);
    $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var tag = '<tr id="tag' + data.id + '"><td>' + data.id + '</td><td>' + data.tagname + '</td><td>' + data.slug + '</td>';
            tag += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
            tag += ' <button class="btn btn-danger btn-delete delete-tag" value="' + data.id + '">Delete</button></td></tr>';
            if (state == "add"){ //jika data baru ditambahkan
                $('#tags-list').append(tag);
            }else{ //jika data diperbaharui
                $("#tag" + tag_id).replaceWith( tag );
            }
            $('#frmTags').trigger("reset");
            $('#myModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
//Menampilkan Isian Form
$('#btn_add').click(function(){
    $('#btn-save').val("add");
    $('#frmTags').trigger("reset");
    $('#myModal').modal('show');
});*/
/*//Menghapus data
$(document).on('click','.delete-tag',function(){
    var tag_id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: url + '/' + tag_id,
        success: function (data) {
            console.log(data);
            $("#tag" + tag_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
//membuat tag / update tag
*/