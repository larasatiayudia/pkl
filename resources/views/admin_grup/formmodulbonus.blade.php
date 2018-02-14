@extends('layout.superadmin')

@include('admin_grup.sidebar')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container-fluid">
<div class="col-md-offset-1 col-md-11">
    <div class="row">
			<div class="col-md-12">
				<div class="page-title">
		   			<ol class="breadcrumb judulmenu"><br><br>
			  			<li class="active" style="color:#E5FFCA">
				 		     <h3><b><i class="fa fa-rocket"></i> Bonus Soal</b></h3>
			  			</li> 
		   			</ol>
				</div>
			</div>
    </div>
    @include('admin_grup.stepbonus')
	<div class="row">
		<div class="col-md-12">

                <div class="panel panel-form">
                    <div class="panel-heading">Setting Modul</div>
                    <div class="panel-body" style="background-color:white">
                        <!-- Buat modul baru -->
                        @if(!isset($modul) || $modul==null)
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/tambahmodul') }}">
                        {{csrf_field()}}
                        <input type="text" name="id_mat" value="{{$materi->id_mat}}" hidden>
                        <input type="text" name="status_modul" value="{{$tipe}}" hidden>
                        <input type="text" name="id_test" value="{{$id_test}}" hidden>                        
	                        <div class="row" id="step-2">
		                        <div class="col-md-12 col-xs-12">
		                        	<div class="row">
		                        		<div class="col-md-10">
					                        <div class="form-group">
					                            <label class="control-label">Nama Modul</label>
					                            <input type="text" required="required" class="form-control" name="nama" placeholder="Masukan nama modul" />
					                        </div>
					                    </div>
			                        </div>

			                            <label class="control-label">Upload Modul</label>
			                            <div class="fileupload fileupload-new" data-provides="fileupload">
										    <span class="btn btn-success btn-file">
										    <span class="fileupload-new">Browse</span>
										    <span class="fileupload-exists">Ubah </span>
										    <input id="fileUpload" type="file" name="modul" onchange="ValidateExtension()" required >
										    </span>
										    <span class="fileupload-preview"></span>
										    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><br>
                                            <span id="lblError" style="color: red"></span>
										 </div>
			                        <button class="btn btn-success nextBtn btn-lg pull-right" type="submit" id="next" style="margin-left:10px">Next</button>
                                    <a href="{{url('admin/formsoalbonus/'.Hashids::encode($id_test,$status))}}" class="btn btn-danger nextBtn btn-lg pull-right" >Skip</a>
                                </div>
	                        </div>
                        </form>
                        <!-- Edit Modul -->
                        @else
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/editmodul') }}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" name="id_modul" value="{{$modul->id_modul}}" hidden>
                        <input type="text" name="id_test" value="{{$id_test}}" hidden>
	                        <div class="row" id="step-2">
		                        <div class="col-md-12 col-xs-12">
		                        	<div class="row">
		                        		<div class="col-md-10">
					                        <div class="form-group">
					                            <label class="control-label">Nama Modul</label>
					                            <input type="text" class="form-control" name="nama" placeholder="Masukan nama modul" value="{{$modul->nama}}" required />
					                        </div>
					                    </div>
			                        </div>
			                            <label class="control-label">Modul yang sudah diupload :</label><br>
			                            <b> {{$modul->file}}</b>
			                            <div class="fileupload fileupload-new" data-provides="fileupload">
										  <br>
                                            <span class="btn btn-success btn-file">
											    <span class="fileupload-new">Ubah</span>
											    <span class="fileupload-exists">Ubah </span>
											    <input id="fileUpload" type="file" name="modul" onchange="ValidateExtension()">
										    </span>
										    <span class="fileupload-preview"></span>
										    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><br>
                                            <span id="lblError" style="color: red"></span>
										 </div>
			                        <button id="next" class="btn btn-success nextBtn btn-lg pull-right" type="submit" style="margin-left:10px">Next</button>
                                    <a href="{{url('admin/formsoalbonus/'.Hashids::encode($id_test,$status))}}" class="btn btn-danger nextBtn btn-lg pull-right" >Skip</a>
                                </div>
	                        </div>
                        </form>
                        @endif
                    </div>
                </div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function notstring(obj){
      if(obj.value!="" && obj.value.search(/[a-z]/g) !== -1 || obj.value!="" && obj.value == "" || obj.value!="" && obj.value.search(/[A-Z]/g) !== -1){
        document.getElementById("notstring").innerHTML = "Isi dengan angka";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else if(obj.value!="" && obj.value > 1440){
        document.getElementById("notstring").innerHTML = "Masukan durasi yang sesuai";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("notstring").innerHTML = "";
        document.getElementById("next").removeAttribute("disabled");
      }
    }
</script>

<script type="text/javascript">
    function ValidateExtension() {
        var allowedFiles = [".pdf"];
        var fileUpload = document.getElementById("fileUpload");
        var lblError = document.getElementById("lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase()) && fileUpload.value!="") {
            lblError.innerHTML = "Silahkan masukkan format file: <b>" + allowedFiles.join(', ') + "</b>.";
            document.getElementById("next").setAttribute("disabled","disabled");
            return false;
        }
        lblError.innerHTML = "";
            document.getElementById("next").removeAttribute("disabled");
            return true;
    }
</script>

<script type="text/javascript" src="{{URL::asset('js/nicEdit-latest.js')}}"></script>

 <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area1');
  });
  //]]>
  </script>
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
