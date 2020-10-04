@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/summernote/summernote-bs4.css">
  <style>
    #drop-area {
  border: 2px dashed #ccc;
  border-radius: 20px;
  width: 480px;
  font-family: sans-serif;
  margin: 100px auto;
  padding: 20px;
}
#drop-area.highlight {
  border-color: purple;
}
p {
  margin-top: 0;
}
.my-form {
  margin-bottom: 10px;
}
#gallery {
  margin-top: 10px;
}
#gallery img {
  width: 150px;
  margin-bottom: 10px;
  margin-right: 10px;
  vertical-align: middle;
}
.button {
  display: inline-block;
  padding: 10px;
  background: #ccc;
  cursor: pointer;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.button:hover {
  background: #ddd;
}
#fileElem {
  display: none;
}

  </style>
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>$title,
    'link'=>[
      [
        'link'=>'/admin/content/',
        'title'=>'Content'
      ],
      [
        '',
        'title'=>$title
      ]
    ]
  ])
  @php
      $title = !empty($data->title) ? $data->title : '';
      $slug = !empty($data->slug) ? $data->slug : '';
      $image = !empty($data->image) ? $data->image : '';
      $gallery = !empty($data->gallery) ? $data->gallery : '';
      $keyword = !empty($data->keyword) ? $data->keyword : '';
      $description = !empty($data->description) ? $data->description : '';
      $content = !empty($data->content) ? $data->content : '';
      $publish = !empty($data->publish) ? $data->publish : '';
  @endphp
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-secondary">
            <form action="/admin/{{$action}}" method="post" enctype="multipart/form-data">
              @csrf
              @if (!empty($method))
                  @method($method)
              @endif
              <div class="card-header">
                <h3 class="card-title">{{__($title.' Content')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($categories))
                  <div class="form-group">
                    @include('form.select',['name'=>'categories[]','data'=>$categories,'select2'=>true,'multiple'=>true])
                  </div>
                @endif
                <div class="form-group">
                  @include('form.text',['name'=>'title','value'=>$title])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'slug','value'=>$slug])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'image','value'=>$image,'type'=>'file','accept'=>'.jpg,.jpeg,.png'])
                  @if (!empty($image))
                    <img src="{{asset('storage/images/content/'.$image)}}" class="img img-fluid" alt="" width="200">
                  @endif
                </div>
                <div class="form-group">
                  <label for="gallery">gallery</label>
                  <progress id="progress-bar" max=100 value=0></progress>
                  <div id="drop-area">
                    <form class="my-form">
                      <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                      <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
                      <label class="button" for="fileElem">Select some files</label>
                    </form>
                    <div id="gallery"></div>
                  </div>
                </div>
                <div class="form-group">
                  @include('form.textarea',['name'=>'content','value'=>$content])
                </div>
                
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-success"> <i class="fa fa-save"></i> {{__('Simpan')}}</button>
                <button class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> {{__('Reset')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="/AdminLte/plugins/toastr/toastr.min.js"></script>
  <script src="/AdminLte/plugins/select2/js/select2.full.min.js"></script>
  <script src="/AdminLte/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $('document').ready(function(){
      $('.select2').select2();
      $('textarea').summernote();
    });
    let dropArea = document.getElementById('drop-area');
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, preventDefaults, false)
    })

    function preventDefaults (e) {
      e.preventDefault()
      e.stopPropagation()
    }
    ;['dragenter', 'dragover'].forEach(eventName => {
      dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, unhighlight, false)
    })

    function highlight(e) {
      dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
      dropArea.classList.remove('highlight')
    }
    dropArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
      let dt = e.dataTransfer
      let files = dt.files

      handleFiles(files)
    }
function handleFiles(files) {
  files = [...files]
  initializeProgress(files.length)
  files.forEach(uploadFile)
  files.forEach(previewFile)
}

function uploadFile(file,i) {
  let url = 'YOUR URL HERE'
  let formData = new FormData()

  formData.append('file', file)

  fetch(url, {
    method: 'POST',
    body: formData
  })
  .then(() => {progressDone})
  .catch(() => { /* Error. Inform the user */ })
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = function() {
    let img = document.createElement('img')
    img.src = reader.result
    document.getElementById('gallery').appendChild(img)
  }
}
let filesDone = 0
let filesToDo = 0
let progressBar = document.getElementById('progress-bar')
let uploadProgress = []
function initializeProgress(numFiles) {
  progressBar.value = 0
  uploadProgress = []

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0)
  }
}
function progressDone() {
  filesDone++
  progressBar.value = filesDone / filesToDo * 100
}
function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
  progressBar.value = total
}


  </script>
  @if (session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
  @endif
@endpush
