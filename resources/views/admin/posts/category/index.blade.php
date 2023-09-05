@extends('admin.layout.app')
@section('content')
    <section>
        <button class="bg-green-700 text-green-300 rounded border px-4 py-2"><a
                href="{{ route('admin.categories.create') }}">Add Category</a></button>

        {{-- Alert --}}
        @if (session('success'))
            <div>
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('success') }}'
                    })
                </script>
            </div>
        @endif
        <table class="w-full border border-collapse table table-striped">
            <tr class="bg-zinc-700 text-zinc-300 text-left ">
                <th class="border p-2">S/N</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Action</th>
            </tr>
            @if (count($categories) > 0)
                @php
                    $sn = 1;
                @endphp
                @foreach ($categories as $category)
                    <tr class="">
                        <td class="border p-2">{{ $sn }}</td>
                        <td class="border p-2">{{ $category->category }}</td>
                        <td class="border p-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="mx-4"><i class="fa-regular fa-pen-to-square text-green-400"></i></a>


                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" class="inline">  
                                @csrf @method('DELETE')
                                <button><i class="fa-solid fa-trash-can text-red-400"></i></button>
                                
                            </form>

                        </td>
                    </tr>
                    @php
                        $sn++;
                    @endphp
                @endforeach
            @else
                <tr>
                    <td>&nbsp;</td>
                    <td class="text-center">No Categories Found</td>
                    <td>&nbsp;</td>
                </tr>
            @endif

        </table>


    </section>
@endsection
