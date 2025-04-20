<!DOCTYPE html
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="{{ 'output.css' }}" rel="stylesheet" />
	<link href="{{ 'main.css' }}" rel="stylesheet" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
</head>

<body class="font-[Poppins]">
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

	<header class="flex flex-col items-center gap-[50px] mt-[70px]">
		<div id="Headline" class="max-w-[1130px] mx-auto flex flex-col gap-4 items-center">
			<p class="w-fit text-[#A3A6AE]">{{ $post->created_at->format('M d, Y') }}</p>
			<h1 id="Title" class="font-bold text-[46px] leading-[60px] text-center two-lines">{{ $post->judul }}</h1>
			<div class="flex items-center justify-center gap-[70px]">
				<a id="Author" href="{{ route('front.author', $post->author->slug) }}" class="w-fit h-fit">
					<div class="flex items-center gap-3">
						<div class="w-10 h-10 overflow-hidden rounded-full">
							<img src="{{ Storage::url($post->thumbnail) }}" class="object-cover w-full h-full" alt="avatar">
						</div>
						<div class="flex flex-col">
							<p class="font-semibold text-sm leading-[21px]">{{ $post->author->username }}</p>
							<p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $post->author->occupation }}</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="w-full h-[500px] flex shrink-0 overflow-hidden">
			<img src="{{ Storage::url($post->thumbnail) }}" class="object-cover w-full h-full" alt="cover thumbnail">
		</div>
	</header>
	<section id="Article-container" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
		<article id="Content-wrapper">
            {!! $post->isi !!}
		</article>
		<div class="side-bar flex flex-col w-[300px] shrink-0 gap-10">
			<div class="flex flex-col w-full gap-3 ads">
				<a href="{{ $square_advertisements->link }}">
					<img src="{{ Storage::url($square_advertisements->thumbnail) }}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
				</p>
			</div>
			<div id="More-from-author" class="flex flex-col gap-4">
				<p class="font-bold">More From Author</p>

                @forelse ($author_posts as $item_author)
				<a href="{{ route('front.details', $item_author->slug) }}" class="card-from-author">
					<div
						class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
						<div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
							<img src="{{ Storage::url($item_author->thumbnail) }}" class="object-cover w-full h-full"
								alt="thumbnail">
						</div>
						<div class="flex flex-col gap-[6px]">
							<p class="font-bold line-clamp-2">{{ substr($item_author->judul, 0, 50) }}{{ strlen($item_author->judul) > 50 ? '...': '' }}</p>
							<p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $item_author->created_at->format('M d, Y') }} • {{ $item_author->category->judul }}</p>
						</div>
					</div>
				</a>
                @empty
                <p>Belum ada artikel</p>
                @endforelse
			</div>
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
	<section id="Up-to-date" class="w-full flex justify-center mt-[70px] py-[50px] bg-[#F9F9FC]">
		<div class="max-w-[1130px] mx-auto flex flex-col gap-[30px]">
			<div class="flex items-center justify-between">
				<h2 class="font-bold text-[26px] leading-[39px]">
					Other News You <br />
					Might Be Interested
				</h2>
			</div>
			<div class="grid grid-cols-3 gap-[30px]">

            @forelse ($posts as $post)
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
            <p>Kosong</p>
            @endforelse

			</div>
		</div>
	</section>

	<script src="{{ asset('customjs/two-lines-text.js') }}"></script>
</body>

</html>
