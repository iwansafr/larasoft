<section class="content">
  <div class="error-page">
    <h2 class="headline text-{{$status}}">{{$title}}</h2>

    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-{{$status}}"></i> {{$msg}}</h3>

      <p>
        <a href="/admin">return to dashboard</a> or try using the search form.
      </p>

      <form class="search-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search">

          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-{{$status}}"><i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>