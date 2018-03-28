@forelse ($contests as $contest)
    <div class="flex {{ $loop->last ? '' : 'mb-6 pb-4' }}">
        <div class="mr-4">
            <img src="{{ $contest->creator->avatar_path }}"
                     alt="{{ $contest->creator->name }}"
                     class="w-8 h-8 bg-blue-darker rounded-full p-2">
        </div>

        <div class="flex-1 {{ $loop->last ? '' : 'border-b border-blue-lightest' }}">
            <h3 class="text-xl font-normal mb-2 tracking-tight">
                <a href="{{ $contest->path() }}" class="text-blue">
                    {{--  @if ($contest->pinned)  --}}
                        {{--  Pinned:  --}}
                    {{--  @endif  --}}

                    {{--  @if (auth()->check() && $contest->hasUpdatesFor(auth()->user()))  --}}
                        {{--  <strong>  --}}
                            {{--  {{ $contest->title }}  --}}
                        {{--  </strong>  --}}
                    {{--  @else  --}}
                        {{ $contest->topic }}
                    {{--  @endif  --}}
                </a>
            </h3>
            @if($contest->active)
            <div class="bg-blue hover:bg-blue-dark text-white font-light py-2 px-4 rounded-full">
                Active
            </div>
            @else
            <div class="bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded-full">
                Inactive
            </div>
            @endif

            <p class="text-2xs text-grey-darkest mb-4">
                Posted By: <a href="{{ route('profile', $contest->creator) }}" class="text-blue">{{ $contest->creator->username }}</a>
            </p>


            <div class="flex items-center text-xs mb-6">
                 {{-- <a class="btn bg-grey-light text-grey-darkest py-2 px-3 mr-4 text-2xs flex items-center" href="/contests/{{ $contest->channel->slug }}">  --}}
                    {{--  <span class="rounded-full h-2 w-2 mr-2" style="background: {{ $contest->channel->color }}"></span>  --}}

                    {{--  {{ ucwords($contest->channel->name) }}  --}}
                {{--  </a>  --}}

                <span class="mr-2 flex items-center text-grey-darker text-2xs font-semibold mr-4">
                    @include ('svgs.icons.eye', ['class' => 'mr-2'])
                    {{--  {{ $contest->visits }} visits  --}}
                </span>

                <a href="{{ $contest->path() }}" class="mr-2 flex items-center text-grey-darker text-2xs font-semibold">
                    @include ('svgs.icons.book', ['class' => 'mr-2'])
                    {{--  {{ $contest->replies_count }} {{ str_plural('reply', $contest->replies_count) }}  --}}
                </a>

                <a class="btn ml-auto is-outlined text-grey-darker py-2 text-xs" href="{{ $contest->path() }}">@lang('contests.read_more')</a>
            </div>
        </div>
    </div>
@empty
    <p>There are no relevant results at this time.</p>
@endforelse
