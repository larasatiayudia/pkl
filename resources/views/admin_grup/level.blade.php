@extends('layout.superadmin')
@section('title', 'Level')

@include('admin_grup.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/profil.css')}}">
@endsection

@section('content')
<div class="container-fluid">
  <div class="col-md-offset-1 col-md-11">
    <div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><i class="fa fa-star"></i> Level</h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>
     
      <!--DATA TABLE-->
      <div class="panel panel-default">
        <div class="panel-body" style="background-color: white"> 
            <ul class="nav nav-tabs" role="tablist">
                @if(isset($tab))
                <li role="presentation"><a href="#level" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-star" aria-hidden="true"></i> <span>Level</span></a></li>
                @else
                <li role="presentation" class="active"><a href="#level" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-star" aria-hidden="true"></i> <span>Level</span></a></li>
                @endif
                @if(isset($tab))
                <li role="presentation" class="active"><a href="#peringkat" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-trophy" aria-hidden="true"></i>  <span>Peringkat Level</span></a></li>
                @else
                <li role="presentation"><a href="#peringkat" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-trophy" aria-hidden="true"></i>  <span>Peringkat Level</span></a></li>
                @endif
                </ul>
         
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <!-- panel biodata (level)-->
                    @if(isset($tab))
                    <div role="tabpanel" class="tab-pane" id="level"><br>
                    @else
                    <div role="tabpanel" class="tab-pane active" id="level"><br>
                    @endif
                         <!--FORM ADD JABATAN-->
                        <div class="form-group">
                          <div class="input-group">
                            <div class="row">
                              <div class="col-md-6">                 
                                <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addlevel"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Level</button>
                              </div>
                              <div class="col-md-3">
                                <form role="form"  method="POST" action="{{url('/admin/resetlevel')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                  <input name="_method" type="hidden" value="PUT">
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Reset poin</button> 
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--END FORM ADD-->
                        <h1>Daftar Level</h1>
                            <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                  <th>Level</th>
                                  <th>Nama Level</th>
                                  <th>Syarat Poin</th>
                                  <th>Icon</th>
                                  <th></th>
                                </thead>
                                <tbody>
                                  @if($levels!=null)
                                  @foreach($levels as $index => $level)
                                  <tr>
                                    <td><h4 style="margin-left: 15px">{{$index+1}}</h4></td>
                                    <td><h4>{{$level->nama_level}}</h4></td>
                                    <td><h4 style="margin-left: 30px">{{$level->point_minimum}}</h4></td>
                                    <td><img src="{{URL::asset('level/'.$level->id_level.'/'.$level->icon)}}" style="width: 45px"></td>
                                    <td class="row"> 
                                            <button style="margin-top: 5px; margin-right: 10px; height: 35px" class="btn btn-primary  open_modal col-md-4" data-title="Edit" data-toggle="modal" data-target="#editlevel" data-id="{{$level->id_level}}" data-name="{{$level->nama_level}}" data-table="Level">
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        
                                        
                                          <form id="deleteform" class="delete" role="form" method="POST" action="{{url('admin/hapuslevel/'.$level->id_level)}}" enctype="multipart/form-data">
                                           
                                              <input type="hidden" name="_method" value="DELETE"/>
                                              <button style="margin-top: 5px;height: 35px" class="btn btn-danger col-md-4" type="button" id="delete" data-id="{{$level->id_level}}" data-name="{{$level->nama_level}}" data-table="Level">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                              </button>
                                           
                                            {{csrf_field()}}
                                          </form>           
                                    </td>
                                  </tr>
                                  @endforeach
                                  @else
                                   <tr>
                                     <td colspan="7">Belum ada data level</td>
                                   </tr>
                                   @endif
                                </tbody>
                              </table>
                       
                            </div>
                            <!--END DATA TABLE-->
                  </div>
                  <!-- panel peringkat level -->
                  @if(isset($tab))
                  <div role="tabpanel" class="tab-pane active" id="peringkat"><br>
                  @else
                  <div role="tabpanel" class="tab-pane" id="peringkat"><br>
                  @endif
                      <div class="row">
                        <div class="col-md-9">
                          <h1>Peringkat Level</h1>
                        </div>
                        <div class="col-md-3">
                          <form method="GET" action="" id="filterform">
                              <select name="filter" id="selectfilter" class="form-control" style="border: 2px solid #eea236">   
                                @if(Request::get('filter')==null || Request::get('filter')=="all")
                                <option selected="true" value="all">Tanpa Filter</option>
                                @else
                                <option value="all">Tanpa Filter</option>
                                @endif
                                @foreach($levels as $level)
                                  @if(Request::get('filter')!=null && Request::get('filter') == $level->id_level)
                                  <option selected="true" value="{{$level->id_level}}">{{$level->nama_level}}</option>
                                  @else
                                  <option value="{{$level->id_level}}">{{$level->nama_level}}</option>
                                  @endif
                                @endforeach
                              </select>
                            </form>            
                        </div>
                      </div>

                            <div class="table-responsive">
                              <table id="tabelperingkat" class="table table-bordred table-striped">
                                <thead>
                                  <th>Peringkat</th>
                                  <th>NIP</th>
                                  <th>Nama</th>
                                  <th>Jabatan</th>
                                  <th>Level</th>
                                  <th>Poin</th>
                                </thead>
                                <tbody>
                                  
                                  @foreach($peringkats as $index => $peringkat)
                                  <tr>
                                    <td><span style="margin-left: 30px">{{$index+1}}</span></td>
                                    <td>{{$peringkat->NIP}}</td>
                                    <td>{{$peringkat->Nama}}</td>
                                    <td>{{$peringkat->jabatan->nama_jabatan}}</td>
                                    <td>{{$current[$index]->nama_level}}</td>
                                    <td>{{$peringkat->point}}</td>
                                  </tr>
                                  @endforeach
                        
                                </tbody>
                              </table>
                       
                            </div>
                  </div>
                </div>
        </div>
      </div>
  </div>
</div>
</div>
</div>



      

<!--Modal Add Level-->
<div class="modal fade" id="addlevel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Level</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="addJabatan" method="POST" action="{{url('/admin/tambahlevel')}}" enctype="multipart/form-data">
          <div class="form-group">
          <label class="control-label" id="namajabatan">Nama Level</label>
          <input id="jabatan" name="namalevel" type="text" required="required" class="form-control" placeholder="Masukkan nama Level" value=""/>
        </div>
        <div class="form-group">
          <label class="control-label" id="namajabatan">Syarat Poin</label>
          <input id="jabatan" name="syaratpoin" type="text" required="required" class="form-control" onkeyup="valpoin(this)" placeholder="Masukkan batas minimum poin" value=""/>
          <span id="alert" style="color: red"></span>
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <label class="control-label" id="namajabatan">Icon Level</label><br>
            <span class="btn btn-success btn-file">
            <span class="fileupload-new">Masukkan gambar</span>
            <span class="fileupload-exists">Ubah </span>
            <input id="fileUpload" type="file" name="icon" onchange="ValidateExtension()" required>
            </span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><br>
            <span id="lblError" style="color: red"></span>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary"> Save </a>
      </div>
        {{csrf_field()}}
        </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   

<!--Modal Edit Level-->
<div class="modal fade" id="editlevel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Level</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="edit" method="POST" action="{{url('/admin/editlevel')}}" enctype="multipart/form-data">
      <input type="text" name="id_level" id="id_level" hidden>
        <div class="form-group">
          <input name="_method" type="hidden" value="PUT">
          <label class="control-label">Nama Level</label>
          <input id="namalevel" name="namalevel" type="text" required="required" class="form-control" placeholder="Masukkan nama Level" value=""/>
        </div>
        <div class="form-group">
          <label class="control-label" id="namajabatan">Syarat Poin</label>
          <input id="syaratpoin2" name="syaratpoin" type="text" required="required" class="form-control" onkeyup="valpoin2(this)" placeholder="Masukkan batas minimum poin" value=""/>
          <span id="alert2" style="color: red"></span>
        </div>
        <div class="form-group">
          <label class="control-label">Icon yang sudah diupload : </label>
          <label id="icon"></label>
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <label class="control-label" id="namajabatan">Icon Level</label><br>
            <span class="btn btn-success btn-file">
            <span class="fileupload-new">Masukkan Gambar</span>
            <span class="fileupload-exists">Ubah </span>
            <input id="fileUpload2" type="file" name="icon" onchange="ValidateExtension2()">
            </span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><br>
            <span id="lblError2" style="color: red"></span>
         </div>
        </div>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save2" type="submit" class="btn btn-primary"> Save change </a>
      </div>
      {{csrf_field()}}
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function ValidateExtension() {
        var allowedFiles = [".png",".jpg",".svg", ".jpeg"];
        var fileUpload = document.getElementById("fileUpload");
        var lblError = document.getElementById("lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase()) && fileUpload.value!="") {
            lblError.innerHTML = "Silahkan masukkan format file: <b>" + allowedFiles.join(', ') + "</b>.";
            document.getElementById("save").setAttribute("disabled","disabled");
            return false;
        }
        lblError.innerHTML = "";
            document.getElementById("save").removeAttribute("disabled");
            return true;
    }
    function ValidateExtension2() {
        var allowedFiles = [".png",".jpg",".svg", ".jpeg"];
        var fileUpload = document.getElementById("fileUpload2");
        var lblError = document.getElementById("lblError2");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase()) && fileUpload.value!="") {
            lblError.innerHTML = "Silahkan masukkan format file: <b>" + allowedFiles.join(', ') + "</b>.";
            document.getElementById("save2").setAttribute("disabled","disabled");
            return false;
        }
        lblError.innerHTML = "";
            document.getElementById("save2").removeAttribute("disabled");
            return true;
    }
    function valpoin(obj){
      if(obj.value!="" && obj.value.search(/[a-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert").innerHTML = "Isi dengan angka";
        document.getElementById("save").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("alert").innerHTML = "";
        document.getElementById("save").removeAttribute("disabled");
      }
    } 
    function valpoin2(obj){
      if(obj.value!="" && obj.value.search(/[a-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert2").innerHTML = "Isi dengan angka";
        document.getElementById("save2").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("alert2").innerHTML = "";
        document.getElementById("save2").removeAttribute("disabled");
      }
    }
</script>

<!-- <script type="text/javascript">
$(document).ready(function() {
  $('select[name="filter"]').on('change', function() {
    var levelID = $(this).val();
    if(levelID) {
      $.ajax({
        url: 'getfilter/'+ levelID,
        type: "GET",
        dataType: "json",
        success:function(data) {
          console.log(data);
          $('select[name="filter"]').empty();
          $('#tabelperingkat').append(data)
        }  
      });
    }
    else{
      $('select[name="filter"]').empty();
    }
  });
});
</script> -->

<script type="text/javascript" src="{{URL::asset('js/ajaxscript.js')}}"></script>
<script>

  $('#editlevel').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
    
        var modal = $(this);
        modal.find('#id_level').val(id);
        $.ajax({
          url : 'getlevel/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
              modal.find('#namalevel').val(data.nama_level);
              modal.find('#syaratpoin2').val(data.point_minimum);
              modal.find('#icon').empty();
              modal.find('#icon').append(data.icon);
          }
        });
  });

  

  @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  @endif

</script>

<script>
  $('#selectfilter').on('change',function(){
    $('#filterform').submit();
  });
</script>

<!-- script button upload -->
<script>
      var file = undefined;
! function(e) {
    var t = function(t, n) {
        this.$element = e(t), this.type = this.$element.data("uploadtype") || (this.$element.find(".thumbnail").length > 0 ? "image" : "file"), this.$input = this.$element.find(":file");
        if (this.$input.length === 0) return;
        this.name = this.$input.attr("name") || n.name, this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]'), this.$hidden.length === 0 && (this.$hidden = e('<input type="hidden" />'), this.$element.prepend(this.$hidden)), this.$preview = this.$element.find(".fileupload-preview");
        var r = this.$preview.css("height");
        this.$preview.css("display") != "inline" && r != "0px" && r != "none" && this.$preview.css("line-height", r), this.original = {
            exists: this.$element.hasClass("fileupload-exists"),
            preview: this.$preview.html(),
            hiddenVal: this.$hidden.val()
        }, this.$remove = this.$element.find('[data-dismiss="fileupload"]'), this.$element.find('[data-trigger="fileupload"]').on("click.fileupload", e.proxy(this.trigger, this)), this.listen()
    };
    t.prototype = {
        listen: function() {
            this.$input.on("change.fileupload", e.proxy(this.change, this)), e(this.$input[0].form).on("reset.fileupload", e.proxy(this.reset, this)), this.$remove && this.$remove.on("click.fileupload", e.proxy(this.clear, this))
        },
        change: function(e, t) {
            if (t === "clear") return;
            var n = e.target.files !== undefined ? e.target.files[0] : e.target.value ? {
                name: e.target.value.replace(/^.+\\/, ""),
                size: e.target.value.size,
            } : null;
            if (!n) {
                this.clear();
                return
            }
            this.$hidden.val(""),
            this.$hidden.attr("name", ""),
            this.$input.attr("name", this.name);
            if (typeof FileReader != "undefined") {
                var r = new FileReader,
                    i = this.$preview,
                    s = this.$element;
                r.onload = function(e) {
                    var result = {
                        name: n.name,
                        data: e.target.result,
                        size: n.size,
                    }
                    i.text(result.name), s.addClass("fileupload-exists").removeClass("fileupload-new")
                }, r.readAsDataURL(n)
            } else this.$preview.text(n.name), this.$element.addClass("fileupload-exists").removeClass("fileupload-new")
        },
        clear: function(e) {
            this.$hidden.val(""), this.$hidden.attr("name", this.name), this.$input.attr("name", "");
            if (navigator.userAgent.match(/msie/i)) {
                var t = this.$input.clone(!0);
                this.$input.after(t), this.$input.remove(), this.$input = t
            } else this.$input.val("");
            this.$preview.html(""), this.$element.addClass("fileupload-new").removeClass("fileupload-exists"), e && (this.$input.trigger("change", ["clear"]), e.preventDefault())
            file = undefined;
        },
        reset: function(e) {
            this.clear(), this.$hidden.val(this.original.hiddenVal), this.$preview.html(this.original.preview), this.original.exists ? this.$element.addClass("fileupload-exists").removeClass("fileupload-new") : this.$element.addClass("fileupload-new").removeClass("fileupload-exists")
        },
        trigger: function(e) {
            this.$input.trigger("click"), e.preventDefault()
        }
    }, e.fn.fileupload = function(n) {
        return this.each(function() {
            var r = e(this),
                i = r.data("fileupload");
            i || r.data("fileupload", i = new t(this, n)), typeof n == "string" && i[n]()
        })
    }, e.fn.fileupload.Constructor = t, e(document).on("click.fileupload.data-api", '[data-provides="fileupload"]', function(t) {
        var n = e(this);
        if (n.data("fileupload")) return;
        n.fileupload(n.data());
        var r = e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');
        r.length > 0 && (r.trigger("click.fileupload"), t.preventDefault())
    })
}(window.jQuery)
  </script>

@endsection
