<section class="card h-100 d-flex flex-column">
    <header class="bg-magenta d-flex align-items-center justify-content-center text-center" style="height: 4.5rem; min-height: 4.5rem;">
        <h4 class="text-white fw-bolder m-0 px-2 fs-5">
            {{ $title }}
        </h4>
    </header>
    <ol class="m-4 d-flex flex-column gap-3 flex-grow-1">
        @foreach($items as $item)
        <li class="fw-bolder"><span class="fw-medium">{{ $item }}</span></li>
        @endforeach
    </ol>
</section>
