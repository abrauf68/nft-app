@extends('frontend.layouts.profile.master')

@section('title', 'Edit Profile')

@section('css')
    <style>
        .avatar-selection {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .avatar-item {
            border: 2px solid transparent;
            border-radius: 50%;
            overflow: hidden;
            width: 70px;
            height: 70px;
            cursor: pointer;
            transition: transform 0.2s, border-color 0.3s;
        }

        .avatar-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-item:hover {
            transform: scale(1.05);
        }

        .avatar-item.selected {
            border-color: #4F46E5;
            /* highlight color */
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.5);
        }

        .avatar-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .avatar-preview img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #4F46E5;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.3);
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('frontend.profile.update') }}" method="POST" class="relative z-10">
        @csrf
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">

            {{-- <div class="flex flex-col gap-3 text-center">
            <h3 class="text-xl font-semibold">Edit Profile</h3>
        </div> --}}

            {{-- ✅ Avatar Selection --}}
            <div class="pt-8">
                {{-- Selected avatar preview --}}
                <div class="avatar-preview">
                    <img id="selectedAvatarPreview"
                        src="{{ asset($profile->profile_image ?? 'frontAssets/images/avatars/1.png') }}"
                        alt="Selected Avatar">
                </div>
                <p class="text-sm font-semibold pb-3 text-center">Choose Your Avatar</p>


                <div class="avatar-selection">
                    @for ($i = 1; $i <= 10; $i++)
                        @php
                            $path = 'frontAssets/images/avatars/' . $i . '.png';
                        @endphp
                        <div class="avatar-item {{ $profile->profile_picture == $path ? 'selected' : '' }}"
                            data-avatar="{{ $path }}">
                            <img src="{{ asset($path) }}" alt="Avatar {{ $i }}">
                        </div>
                    @endfor
                </div>
                <input type="hidden" name="profile_picture" id="profile_picture" value="{{ $profile->profile_picture }}">
            </div>

            {{-- ✅ Name Field --}}
            <div class="pt-8">
                <p class="text-sm font-semibold pb-2">{{ __('Name') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('name') is-invalid @enderror">
                    <input type="text" placeholder="Enter Name" name="name" value="{{ old('name', $user->name) }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18"
                        required />
                    <i class="ph ph-user text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="pt-4">
                <p class="text-sm font-semibold pb-2">{{ __('Email') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('email') is-invalid @enderror">
                    <input type="email" disabled placeholder="Enter Email" value="{{ old('email', $user->email) }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18"
                        />
                    <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- ✅ Phone Field --}}
            <div class="pt-8">
                <p class="text-sm font-semibold pb-2">{{ __('Phone') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('phone_number') is-invalid @enderror">
                    <input type="text" placeholder="i.e. +92 310 0000000" name="phone_number"
                        value="{{ old('phone_number', $profile->phone_number) }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18" />
                    <i class="ph ph-phone text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <button style="width: 100%;" type="submit"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">
            Save
        </button>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarItems = document.querySelectorAll('.avatar-item');
            const avatarInput = document.getElementById('profile_picture');
            const avatarPreview = document.getElementById('selectedAvatarPreview');

            avatarItems.forEach(item => {
                item.addEventListener('click', () => {
                    avatarItems.forEach(i => i.classList.remove('selected'));
                    item.classList.add('selected');

                    const selectedPath = item.getAttribute('data-avatar');
                    avatarInput.value = selectedPath;
                    avatarPreview.src = `/${selectedPath}`; // show preview
                });
            });
        });
    </script>
@endsection
