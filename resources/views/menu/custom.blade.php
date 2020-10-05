@extends('dashboard')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/> --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/> --}}
    <link rel="stylesheet" href="/menu/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css">
    <style>
      .list-group-item{
        margin-bottom: 5px;
        border-top-width: thin!important;
      }
    </style>
@endpush
@section('content')
@include('form.header',
  [
    'header'=>'Menu',
    'link'=>[
      [
        'link'=>'/admin/menu',
        'title'=>'Menu'
      ],
      [
        '',
        'title'=>'Menu Custom'
      ],
    ],
  ])
<section class="content">
  <div class="row">
      <div class="col-md-8">
          <div class="card mb-3">
              <div class="card-header"><h5 class="float-left">Menu</h5>
                  <div class="float-right">
                      <button id="btnReload" type="button" class="btn btn-outline-secondary">
                          <i class="fa fa-play"></i> Load Data</button>
                  </div>
              </div>
              <div class="card-body">
                  <ul id="myEditor" class="sortableLists list-group">
                  </ul>
              </div>
          </div>
          <p>Click the Output button to execute the function <code>getString();</code></p>
          <div class="card">
          <div class="card-header">JSON Output
          <div class="float-right">
          <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Output</button>
          </div>
          </div>
          <div class="card-body">
          <div class="form-group">
            <textarea id="out" class="form-control" cols="50" rows="10" name="param"></textarea>
            @csrf
          </div>
          </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card border-primary mb-3">
              <div class="card-header bg-primary text-white">Edit item</div>
              <div class="card-body">
                  <form id="frmEdit" class="form-horizontal">
                      <div class="form-group">
                          <label for="text">Text</label>
                          <div class="input-group">
                              <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                              <div class="input-group-append">
                                  <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                              </div>
                          </div>
                          <input type="hidden" name="icon" class="item-menu">
                      </div>
                      <div class="form-group">
                          <label for="href">URL</label>
                          <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                      </div>
                      <div class="form-group">
                          <label for="target">Target</label>
                          <select name="target" id="target" class="form-control item-menu">
                              <option value="_self">Self</option>
                              <option value="_blank">Blank</option>
                              <option value="_top">Top</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="title">Tooltip</label>
                          <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                      </div>
                  </form>
              </div>
              <div class="card-footer">
                  <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                  <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
@push('scripts')
    {{-- <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> --}}
    {{-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> --}}
    <script type="text/javascript" src="/menu/jquery-menu-editor.min.js"></script>
    <script type="text/javascript" src="/menu/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
    <script type="text/javascript" src="/menu/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            // menu items
            var arrayjson = <?php echo json_encode($data->param);?>;
            console.log(arrayjson);
            // var arrayjson = [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-crop","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];
            // console.log(arrayjson);
            // icon picker options
            var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
            // sortable list options
            var sortableListOptions = {
                placeholderCss: {'background-color': "#cccccc"}
            };

            var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));
            editor.setData(arrayjson);
            $('#btnOutput').on('click', function () {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              var str = editor.getString();
              $("#out").text(str);
              var param = $('#out').val();
              var token = $('input[name="_token"]').val();
              var id = {{$data->id}};
              $.ajax({
                url: '/admin/updatemenu/',
                type: 'PUT',
                data: {
                  id:id,
                  param:param,
                  token:token
                },
                success:function(response){
                  console.log(response);
                }
              });
            });
            $("#btnUpdate").click(function(){
                editor.update();
            });

            $('#btnAdd').click(function(){
                editor.add();
            });
            /* ====================================== */

            /** PAGE ELEMENTS **/
            $('[data-toggle="tooltip"]').tooltip();
            $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                $('#btnStars').html(data.stargazers_count);
                $('#btnForks').html(data.forks_count);
            });
        });
    </script>
@endpush