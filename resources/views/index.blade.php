@extends('layout.app')
@section('content')
    <div class="md:flex justify-between gap-2">
        {{-- Center --}}
        <div class="md:w-6/12  order-2">
            {{-- Slider --}}
            <div id="my-slider" class="bg-white">
                <div class="transition duration-150 ease-in-out"> <img
                        src="https://cdn.pixabay.com/photo/2020/07/08/04/12/work-5382501_1280.jpg" alt="Home Banner"
                        srcset="">
                </div>
                <div><img src="https://cdn.pixabay.com/photo/2023/08/18/19/44/dog-8199216_1280.jpg" alt=""></div>
                <div><img src="https://cdn.pixabay.com/photo/2016/12/13/00/13/rabbit-1903016_1280.jpg" alt=""></div>
            </div>
            {{-- Posts --}}
            @foreach ($blogs as $blog)
           
             
               
          
            <div class="py-3 bg-white px-2">
                <div class="text-xs">
                    <span><i class="fa-regular fa-calendar"></i> {{ $blog->created_at->diffForHumans() }}</span>
                    <span><i class="fa-solid fa-folder-open"></i>{{   $blog->category }}</span>
                    <span><i class="fa-solid fa-user"></i>Posted By:  {{ $blog->author->name }}</span>
                    <span><i class="fa-solid fa-comments"></i>No Comment</span>
                </div>
                <h2 class="text-red-700 text-xl leading-4 font-bold py-3 capitalize"> <a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }} </a> </h2>
                <div class="flex gap-2">
                    <div class="w-2/5 ">
                        <img src="{{ asset('public/images', $blog->img) }}"
                            alt="Post image" class="">
                    </div>
                    <div class="w-3/5">
                        {{ $blog->content }}
                        <div class="text-right">
                            <button
                                class="bg-red-700 text-red-200 rounded px-4 py-2 hover:bg-red-200 hover:text-red-700">Read
                                More...</button>
                        </div>
                    </div>

                </div>
            </div>
              @endforeach
            <hr>



            <hr>
            <div class="text-right">
                <a href="" class="text-red-700 italic">Older Posts</a>
            </div>

        </div>

        {{-- Right sidebar --}}
        <div class="md:w-3/12 order-1 text-gray-600">
            <div class="bg-white my-2">

                <div class="bg-red-700 p-3 font-semibold text-gray-100">Categories</div>
                <div class="mx-4">
                    <ul>
                        <li><a href="">Politics</a></li>
                        <li><a href="">Fashion</a></li>
                        <li><a href="">Music</a></li>
                        <li><a href="">Entertainment</a></li>
                        <li><a href="">Religion</a></li>
                        <li><a href="">Business</a></li>

                    </ul>
                </div>
            </div>
            <div class="bg-white">

                <div class="bg-red-700 p-3 font-semibold text-gray-100">Archaive</div>
                <div class="mx-4">
                    <ul>
                        <li><a href="">Politics</a></li>
                        <li><a href="">Fashion</a></li>
                        <li><a href="">Music</a></li>
                        <li><a href="">Entertainment</a></li>
                        <li><a href="">Religion</a></li>
                        <li><a href="">Business</a></li>

                    </ul>
                </div>
            </div>
        </div>


        {{-- Left Sidebar --}}
        <div class="md:w-3/12 order-3 bg-gray-300 text-gray-600">
            <div class="bg-red-700 h-1">&nbsp;</div>
            <div class="py-2 bg-white my-2">
                <form action="" method="get">
                    <input type="search" name="search" id="search" class=" rounded-sm border border-gray-500">
                    <input type="submit" value="Search"
                        class="bg-red-700 text-red-200 hover:bg-red-200 hover:text-red-700 py-2 px-5">
                </form>
            </div>

            {{-- popular Posts --}}
            <div class="bg-white my-2">

                <div class="bg-red-700 p-3 font-semibold text-gray-100">Popular Posts</div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2018/02/05/23/05/death-valley-3133502_1280.jpg"
                            alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2015/01/08/18/27/startup-593341_1280.jpg" alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2018/01/06/09/25/hijab-3064633_1280.jpg" alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
            </div>

            {{-- popular Posts --}}
            <div class="bg-white my-2">

                <div class="bg-red-700 p-3 font-semibold text-gray-100">Recent Posts</div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2018/02/05/23/05/death-valley-3133502_1280.jpg"
                            alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2015/01/08/18/27/startup-593341_1280.jpg" alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
                <div class="m-2 flex">
                    <div class="w-2/6">
                        <img src="https://cdn.pixabay.com/photo/2018/01/06/09/25/hijab-3064633_1280.jpg" alt="">
                    </div>
                    <div class="w-4/6">
                        <p class="text-red-700 md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                        <p class="md:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            explicabo, </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
