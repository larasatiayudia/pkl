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

    <div class="row">
        <div class="col-md-12">
            <!-- panel keseluruhan soal -->
            <div class="panel panel-form">
                <div class="panel-heading">Soal</div>
                    <div class="panel-body" style="background-color:white">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" data-id="{{$test->id_test}}" hidden><i class="fa fa-plus" aria-hidden="true"></i> Tambah Soal</button>
                        <!-- Klo jumlah soal yang dibuat >= jumlah soal test yang udah ditentuin -->
                        @if($soals->total() >= $test->jumlah_soal)
                        <a href="{{url('admin/tipetesbonus/'.Hashids::encode($test->materi->id_mat,$status))}}" type="button" class="btn btn-success pull-right"><i class="fa fa-check-circle" aria-hidden="true"></i> Finish</a>
                        <br><br>
                        @else
                        <!-- Klo jumlah soal yang dibuat < jumlah soal test yang udah ditentuin -->
                        <button id="finish" type="button" class="btn btn-success pull-right"><i class="fa fa-check-circle" aria-hidden="true"></i> Finish</button>
                        <br><br>
                        @endif
                        
                            <!-- panel nomor soal -->
                            @if(!empty($soals))
                            @foreach($soals as $index => $soal)
                            <div class="col-md-1 visible-lg">
                                <div class="panel panel-warning" style="margin-left: 10px;">
                                  <div class="panel-heading" style="margin-right: -60px; border: 2px solid #eeaa00;border-radius: 5px; ">
                                    <h4 class="text-warning" style="margin-left: 10px">{{$soals->total()-($soals->firstItem()+$index)+1}}</h4>
                                  </div>
                                </div>
                            </div>
                            <!-- panel soal -->
                            <div class="col-md-11 col-xs-12">
                                <div class="panels panel-default">
                                  <div class="panel-body" id="1" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 40px"><br>
                                    <div class="row">

                                    <!-- nomor untuk mobile -->
                                        <div class=" col-xs-8 visible-xs" style="text-align: center; margin-left: 50px">
                                            <div class="panel panel-warning">
                                              <div class="panel-heading" style="background-color: #eeaa00;border: 2px solid #eeaa00;border-radius: 5px">
                                                <h4 class="text-warning">Question {{$soals->total()-($soals->firstItem()+$index)+1}}</h4>
                                              </div>
                                            </div>
                                        </div>

                                        <!-- soal buat PC dan mobile -->
                                        <div class="col-md-9 col-xs-9">
                                            {{$soal->soal}}
                                        </div>
                                        <div class="col-md-1 col-xs-1">
                                            <button type="button" style="margin-left: -15px" class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{$soal->id_soal}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </button>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/soal/'.$soal->id_soal) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" id="delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus </button>
                                            </form>
                                        </div>
                                    </div> <br>

                                    <!-- pilihan ganda -->
                                    <div data-toggle="buttons">
                                        <div class="row">
                                            <div class="col-md-1 col-xs-2">
                                                @if($soal->kunci_jawaban=='a')
                                                <div class="btn btn-warning active disabled" style="height: 33px"> A
                                                @else
                                                <div class="btn btn-warning disabled" style="height: 33px"> A
                                                @endif
                                                    <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                </div>
                                                </div>
                                                <div class="col-md-8 col-xs-10">
                                                    <div class="panel panel-warning">
                                                      <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
                                                        <font size="2">{!!$soal->opsi_a!!}</font>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                            <div class="row">
                                                <div class="col-md-1 col-xs-2">
                                                    @if($soal->kunci_jawaban=='b')
                                                    <div class="btn btn-warning active disabled" style="height: 33px"> B
                                                    @else
                                                    <div class="btn btn-warning disabled" style="height: 33px"> B
                                                    @endif
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>                                          
                                                    <div class="col-md-8 col-xs-10">
                                                        <div class="panel panel-warning">
                                                          <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
                                                            <font size="2">{!!$soal->opsi_b!!}</font>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-1 col-xs-2">
                                                        @if($soal->kunci_jawaban=='c')
                                                        <div class="btn btn-warning active disabled" style="height: 33px"> C
                                                        @else
                                                        <div class="btn btn-warning disabled" style="height: 33px"> C
                                                        @endif
                                                            <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                        </div>
                                                    </div>                                            <div class="col-md-8 col-xs-10">
                                                        <div class="panel panel-warning">
                                                          <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
                                                            <font size="2">{!!$soal->opsi_c!!}</font>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-1 col-xs-2">
                                                            @if($soal->kunci_jawaban=='d')
                                                            <div class="btn btn-warning active disabled" style="height: 33px"> D
                                                            @else
                                                            <div class="btn btn-warning disabled" style="height: 33px"> D
                                                            @endif
                                                                <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                            </div>
                                                            </div>                                            
                                                            <div class="col-md-8 col-xs-10">
                                                                <div class="panel panel-warning">
                                                                  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
                                                                    <font size="2">{!!$soal->opsi_d!!}</font>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        @endforeach
                                        {{ $soals->links() }}
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
            </div>
        </div>
    </div>
</div>

                        <!-- Modal Form Soal -->
                        <div id="createModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                          <div class="modal-dialog modal-lg" role="document" >
                            <div class="modal-content">
                               <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Form Soal</h4>
                                </div>
                                <div class="modal-body">
                             
                                    <form role="form" method="POST" enctype="multipart/form-data"  action="{{ url('admin/tambahsoal') }}">
                                    {{csrf_field()}}
                                    <input type="text" name="id_test" id="id_test" hidden>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="alert alert-info" role="alert"> <h4>Klik pada salah satu pilihan ganda, untuk menentukan kunci jawaban yang anda butuhkan!</h4></div>
                                               
                                                <label class="control-label">Soal</label>
                                                <textarea name="soal" class="form-control" style="height: 80px; width: 720px" id="area1"></textarea><br>
                                                <div style="color: red" id="alert1"></div>
                                            </div>
                                            

                                            <div data-toggle="buttons">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option1" autocomplete="off" value="a" hidden> A
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_a" class="form-control" style="height: 50px; width: 600px" id="area2"></textarea>
                                                    </label>
                                                    </div>
                                                </div>
                               
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option2" autocomplete="off" value="b" hidden> B
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_b" class="form-control" style="height: 50px; width: 600px" id="area3"></textarea>
                                                    </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option3" autocomplete="off" value="c" hidden> C
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_c" class="form-control" style="height: 50px; width: 600px" id="area4"></textarea>
                                                    </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option4" autocomplete="off" value="d" hidden> D
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_d" class="form-control" style="height: 50px; width: 600px" id="area5"></textarea>
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button  id="submit" type="submit" class="btn btn-primary" disabled>Submit</button>
                                        </form>
                                    </div>

                                </div>
                              </div>
                            </div>

                            <!-- modal edit soal -->
                            <div id="editModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Form Edit Soal</h4>
                                      </div>
                                  <div class="container">
                                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/editsoal') }}">
                                    {{csrf_field()}}
                                    <input type="text" name="id_soal" id="id_soal" hidden>
                                    <input type="hidden" name="_method" value="PUT">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label">Soal</label>
                                                <textarea name="soal" class="form-control" style="height: 80px; width: 600px" id="area6"></textarea>
                                            </div>

                                            <div data-toggle="buttons">
                                                <div class="row">
                                                    <div id="jawaban_a" class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option2" autocomplete="off" value="a" hidden> A
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_a" class="form-control" style="height: 50px; width: 600px" id="area7"></textarea>
                                                    </label>
                                                    </div>
                                                </div>
                               
                                                <div class="row">
                                                    <div id="jawaban_b" class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option2" autocomplete="off" value="b" hidden> B
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_b" class="form-control" style="height: 50px; width: 600px" id="area8"></textarea>
                                                    </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div id="jawaban_c" class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option2" autocomplete="off" value="c" hidden> C
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_c" class="form-control" style="height: 50px; width: 600px" id="area9"></textarea>
                                                    </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div id="jawaban_d" class="col-md-1 col-xs-2">
                                                    <div class="btn btn-warning" style="height: 33px">
                                                        <input type="radio" name="kunci_jawaban" id="option2" autocomplete="off" value="d" hidden> D
                                                        <span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-10">
                                                    <label>
                                                    <textarea name="opsi_d" class="form-control" style="height: 50px; width: 600px" id="area10"></textarea>
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button  type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                </div>

                              </div>
                            </div>
                        <!-- modalnya sampe sini -->

    <div class="scroll-top-wrapper ">
      <span class="scroll-top-inner">
        <i class="fa fa-2x fa-arrow-circle-up"></i>
      </span>
    </div>


<script type="text/javascript">
setInterval(function(){
    var soal =  nicEditors.findEditor( 'area1' ).getContent();
    var isi_a =  nicEditors.findEditor( 'area2' ).getContent();
    var isi_b =  nicEditors.findEditor( 'area3' ).getContent();
    var isi_c =  nicEditors.findEditor( 'area4' ).getContent();
    var isi_d =  nicEditors.findEditor( 'area5' ).getContent();
    if((soal!="<br>" || soal!="") && (isi_a!="<br>" || isi_a!="") && (isi_b!="<br>" || isi_b!="") && (isi_c!="<br>" || isi_c!="") && (isi_d!="<br>" || isi_d!="") && (document.getElementById('option1').checked || document.getElementById('option2').checked || document.getElementById('option3').checked || document.getElementById('option4').checked)){
         document.getElementById("submit").removeAttribute("disabled");

    }
    else{
        document.getElementById("submit").setAttribute("disabled","disabled");
    }
 }, 1000);
</script>

<script type="text/javascript">
    $(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
        if ($(window).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });
 
    $('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});
</script>

<script type="text/javascript" src="{{URL::asset('js/nicEdit-latest.js')}}"></script> 
 <script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function() {
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area1');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area2');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area3');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area4');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area5');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area6');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area7');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area8');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area9');
            new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area10');
            var textareas = document.getElementsByTagName("textarea");

            for(var i=0;i<textareas.length;i++)
             {
                var myNicEditor = new nicEditor();
                myNicEditor.panelInstance(textareas[i]);

             }
    });
    //]]>
</script>


<script type="text/javascript">
    $('#createModal').on('show.bs.modal', function(event) {
            var link = $(event.relatedTarget);
            var id = link.data('id');

            var modal = $(this);
            modal.find('#id_test').val(id);
    });

    $('#editModal').on('show.bs.modal', function(event) {
            var link = $(event.relatedTarget);
            var id = link.data('id');

            var modal = $(this);
            modal.find('#id_soal').val(id);

            $.ajax({
                url: '/admin/editmodal/'+id,
                success:function(data){
                    nicEditors.findEditor( 'area6' ).setContent( data.soal );
                    nicEditors.findEditor( 'area7' ).setContent( data.opsi_a );
                    nicEditors.findEditor( 'area8' ).setContent( data.opsi_b );
                    nicEditors.findEditor( 'area9' ).setContent( data.opsi_c );
                    nicEditors.findEditor( 'area10' ).setContent( data.opsi_d );
                    switch(data.kunci_jawaban){
                        case 'a':
                            $("#jawaban_a div.btn-warning").removeClass().addClass('btn btn-warning active');
                            $('#jawaban_a').find(':radio[name=kunci_jawaban][value="a"]').prop('checked',true);
                            break;
                        case 'b':
                            $("#jawaban_b div.btn-warning").removeClass().addClass('btn btn-warning active');
                            $('#jawaban_b').find(':radio[name=kunci_jawaban][value="b"]').prop('checked',true);
                            break;
                        case 'c':
                            $("#jawaban_c div.btn-warning").removeClass().addClass('btn btn-warning active');
                            $('#jawaban_c').find(':radio[name=kunci_jawaban][value="c"]').prop('checked',true);
                            break;
                        case 'd':
                            $("#jawaban_d div.btn-warning").removeClass().addClass('btn btn-warning active');
                            $('#jawaban_d').find(':radio[name=kunci_jawaban][value="d"]').prop('checked',true);
                            break;
                    }
                }
            });

            $("#jawaban_a div.active").removeClass().addClass('btn btn-warning');
            $("#jawaban_b div.active").removeClass().addClass('btn btn-warning');
            $("#jawaban_c div.active").removeClass().addClass('btn btn-warning');
            $("#jawaban_d div.active").removeClass().addClass('btn btn-warning');
    });
   $('button#delete').on('click', function(){
        swal({   
        title: "Apa anda yakin?",
        text: "Anda tidak dapat mengembalikan soal yang sudah dihapus!", 
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus ini!", 
        closeOnConfirm: false 
        },
        function(){   
            $("#deleteform").submit();
        });
    });

    $('button#finish').on('click',function(){
        swal("Ooppss...","Soal yang anda buat kurang","error");
    });

    @if(Session::has('msg'))
        swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
    @endif
</script>
@endsection