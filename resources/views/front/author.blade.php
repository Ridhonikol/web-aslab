<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="{{ asset('output.css') }}" rel="stylesheet" />
	<link href="{{ asset('main.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
		rel="stylesheet" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="font-[Poppins] pb-[83px]">
<x-navbar/>
    <nav id="Category" class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">

        @foreach ($categories as $item_category)
        <a href="{{ route('front.category', $item_category->slug) }}" class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
            <div class="flex w-6 h-6 shrink-0">
                <img src="{{ Storage::url($item_category->icon) }}" alt="icon" />
            </div>
            <span>{{ $item_category->judul }}</span>
        </a>
        @endforeach
    </nav>
	<section id="author" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
		<div id="title" class="flex items-center gap-[30px]">
			<h1 class="text-4xl leading-[45px] font-bold">Author News</h1>
			<h1 class="text-4xl leading-[45px] font-bold">/</h1>
			<div class="flex items-center gap-3">
				<div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
					<img src="{{ Storage::url($authors->first()->avatar) }}" alt="profile photo" />
				</div>
				<div class="flex flex-col">
					<p class="text-lg leading-[27px] font-semibold">{{ $authors->first()->username }}</p>
					<span class="text-[#A3A6AE]">{{ $authors->first()->occupation }}</span>
				</div>
			</div>
		</div>
		<div id="content-cards" class="grid grid-cols-3 gap-[30px]">

            @forelse ($authors->first()->posts as $post)
			<a href="{{ route('front.details', $post->slug) }}" class="card">
				<div
					class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
					<div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
						<div
							class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
							<p class="text-xs leading-[18px] font-bold uppercase">{{ $post->category->judul }}</p>
						</div>
						<img src="{{ Storage::url($post->thumbnail) }}" alt="thumbnail photo"
							class="object-cover w-full h-full" />
					</div>
					<div class="flex flex-col gap-[6px]">
						<h3 class="text-lg leading-[27px] font-bold">{{ $post->judul }}</h3>
						<p class="text-sm leading-[21px] text-[#A3A6AE]">{{ $post->created_at->format('M d, Y') }}</p>
					</div>
				</div>
			</a>
            @empty
            <p>belum ada data artikel</p>
            @endforelse
		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
			<a href="{{ $banner_advertisements->link }}">
				<div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
					<img src="{{ Storage::url($banner_advertisements->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
				</div>
			</a>
			<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
						src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
			</p>
		</div>
	</section>
</body>

</html>
