<div>
    <div class="col-sm-12">
        <div class="profile-bg-picture"
            style="background-image:url({{Auth::user()->cover_image ? Auth::user()->cover_image : asset('assets/admin/images/default/bg-profile.jpg') }})">
            <span class="picture-bg-overlay"></span>
            <!-- overlay -->
        </div>
        <!-- meta -->
        <div class="profile-user-box">
            <div class="row">
                <div class="col-sm-6">
                    <div class="profile-user-img"><img src="{{Auth::user()->image ? Auth::user()->image : asset('assets/admin/images/default/avatar-1.jpg') }}"
                            alt="" class="avatar-lg rounded-circle"></div>
                    <div class="">
                        <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                        <p class="font-13"> {{ @$user->email }}</p>
                        <p class="text-muted mb-0"><small>{{ $user->country }}, {{ @$user->city }}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
