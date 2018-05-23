@forelse ($contests as $contest)
<div class="card mx-4" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">
        <a href="{{ $contest->path() }}">
            {{ $contest->topic }}
        </a>
        @if($contest->active)
        <div class="badge badge-pill badge-info">
            Active
        </div>
        @else
        <div class="badge badge-pill badge-warning">
            Inactive
        </div>
        @endif

    </h5>
    <p class="card-text">
        Posted By: <a href="{{ route('profile.index', $contest->creator) }}" class="text-blue">{{ $contest->creator->username }}</a>
    </p>
    <a class="btn btn-primary" href="{{ $contest->path() }}">@lang('contests.read_more')</a>
</div>
</div>
@empty
<p>There are no contests in this project.</p>
@endforelse
