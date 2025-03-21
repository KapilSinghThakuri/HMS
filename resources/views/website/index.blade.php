@extends('website.layout.main')
@section('Main-container')
    @inject('faq_helper', 'App\Helpers\FAQHelper')
    @inject('department_helper', 'App\Helpers\DepartmentHelper')
    @inject('gallery_category_helper', 'App\Helpers\GalleryCategoryHelper')
    @inject('siteinfo_helper', 'App\Helpers\WebsiteInfoHelper')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to Healwave</h1>
            <h2>Safe, Reliable, Compassionate Healthcare.</h2>
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section>

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Why Choose Healwave?</h3>
                            <p>
                                At Healwave, we prioritize your health and well-being. Our team of highly skilled healthcare
                                professionals is dedicated to providing personalized care with compassion and excellence. We
                                offer a wide range of services, from preventive care to advanced medical treatments,
                                ensuring you receive the best possible care.
                            </p>
                            <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <h4>Comprehensive Services</h4>
                                        <p>We offer healthcare services from check-ups to specialized treatments.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Advanced Technology</h4>
                                        <p>We use advanced medical technology for accurate diagnoses and effective
                                            treatments.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-images"></i>
                                        <h4>Compassionate Care</h4>
                                        <p>Our team delivers compassionate and respectful patient care.</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">

                <div class="row">
                    @foreach ($pages as $page)
                        @if ($page->slug == 'about-us')
                            <div class="col-xl-5 col-lg-6 pb-4 pt-4 video-box d-flex justify-content-center align-items-stretch position-relative"
                                style="background: url({{ asset($page->image) }}) center center no-repeat; background-size: cover;">
                                <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a> -->
                            </div>

                            <div
                                class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                                <h3>{{ $page['title'][$current_locale] }}</h3>
                                <p>{!! $page['content'][$current_locale] !!}</p>
                        @endif

                        @if ($page->slug == 'comprehensive-medical-services')
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-fingerprint"></i></div>
                                <h4 class="title"><a href="">{{ $page['title'][$current_locale] }}</a></h4>
                                <p class="description">{!! $page['content'][$current_locale] !!}</p>
                            </div>
                        @endif

                        @if ($page->slug == 'dedicated-and-compassionate-staff')
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-gift"></i></div>
                                <h4 class="title"><a href="">{{ $page['title'][$current_locale] }}</a></h4>
                                <p class="description">{!! $page['content'][$current_locale] !!}</p>
                            </div>
                        @endif

                        @if ($page->slug == 'innovative-technology-and-equipment')
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-atom"></i></div>
                                <h4 class="title"><a href="">{{ $page['title'][$current_locale] }}</a></h4>
                                <p class="description">{!! $page['content'][$current_locale] !!}</p>
                            </div>
                </div>
                @endif
                @endforeach
            </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="fas fa-user-md"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $doctors->count() }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Doctors</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="far fa-hospital"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $departments->count() }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Departments</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-flask"></i>
                            <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Research Labs</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-award"></i>
                            <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Awards</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Departments Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>@lang('index.department_title')</h2>
                    <p>{{ __('index.department') }}</p>
                </div>

                <div class="row">
                    @foreach ($department_helper->getAllDepartment()->take(6) as $department)
                        <div class="col-lg-4 col-md-6 p-3">
                            <div class="icon-box">
                                <div class="icon">
                                    <i
                                        class="{{ $department_helper->getDepartmentIcon($department->department_name) }}"></i>
                                </div>
                                <h4><a href="">{{ $department->department_name }}</a></h4>
                                <p>{!! Str::limit($department->department_desc, 85, '...') !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Departments Section -->

        <!-- ======= Appointment Section ======= -->
        <section id="departments" class="departments">
            <div class="container">

                <div class="section-title">
                    <h2>{{ __('index.appointment_title') }}</h2>
                    <p>{{ __('index.appointment') }}</p>
                </div>
                <div class="alert alert-info text-center" role="alert">
                    {!! __('index.appointment_note') !!}
                </div>

                <div class="row gy-4">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            @foreach ($departments as $department)
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tab-{{ $department->id }}"
                                        data-department-id="{{ $department->id }}">{{ $department->department_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content">
                            @foreach ($departments as $department)
                                <div class="tab-pane" id="tab-{{ $department->id }}">
                                    <div class="row gy-4">
                                        {{-- <div class="col-lg-8 details order-2 order-lg-1"> --}}
                                        <h3>{{ $department->department_name }}'s Available Doctors</h3>

                                        <div class="row" id="available-doctors">
                                            @foreach ($department->doctors as $doctor)
                                                <div class="col-md-4">
                                                    <div class="card bg-primary profile-card"
                                                        data-doctor-id="{{ $doctor->id }}" style="cursor: pointer;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#scheduleModal-{{ $doctor->id }}">
                                                        <div class="profile-img">
                                                            <img src="{{ asset($doctor->profile) }}" alt="Profile Image">
                                                        </div>
                                                        <div class="profile-details">
                                                            <div class="profile-name">
                                                                {{ $doctor->first_name }}{{ $doctor->middle_name }}
                                                                {{ $doctor->last_name }}</div>
                                                            {{-- <div class="profile-specialization">{{ $doctor->educations[0]->specialization }}</div> --}}
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="scheduleModal-{{ $doctor->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="scheduleModalLabel-{{ $doctor->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="scheduleModalLabel-{{ $doctor->id }}">
                                                                        Select your suitable schedule</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                @php
                                                                    $doctor_schedules = collect([]);
                                                                    foreach ($schedules as $schedule) {
                                                                        if ($schedule->doctor_id == $doctor->id) {
                                                                            $doctor_schedules->push($schedule);
                                                                        }
                                                                    }
                                                                @endphp

                                                                @if ($doctor_schedules->isEmpty())
                                                                    <p class="alert alert-danger">No Schedule !!! </p>
                                                                @else
                                                                    @foreach ($doctor_schedules as $schedule)
                                                                        @php
                                                                            $timeIntervals = $schedule->time_intervals;
                                                                        @endphp
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <p>{{ $schedule->in }}'s Schedules</p>
                                                                                @foreach ($timeIntervals as $interval)
                                                                                    <!-- Check if the schedule time_interval is exist in interval or not -->
                                                                                    @if (!$doctor->appointments->where('schedule_id', $schedule->id)->pluck('time_interval')->contains($interval))
                                                                                        <div class="col-4 p-2">
                                                                                            <a
                                                                                                href="{{ route('appointment.create', ['schedule' => $schedule->id, 'interval' => $interval]) }}">
                                                                                                <span
                                                                                                    class="custom-badge status-blue">{{ $interval }}</span>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End Appointment Section -->


        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">
            <div class="container">

                <div class="section-title">
                    <h2>{{ __('index.doctor_title') }}</h2>
                    <p>{{ __('index.doctor') }}</p>
                </div>

                <div class="row">
                    @foreach ($doctors->take(4) as $doctor)
                        <div class="col-lg-6 p-2">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="{{ asset($doctor->profile) }}" class="img-fluid"
                                        alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}
                                    </h4>
                                    <span>Chief Medical Officer</span>
                                    <p>'An experienced and compassionate healthcare professional, committed to providing
                                        excellent care and ensuring patient satisfaction'</p>
                                    <div class="social">
                                        <a href=""><i class="ri-twitter-fill"></i></a>
                                        <a href=""><i class="ri-facebook-fill"></i></a>
                                        <a href=""><i class="ri-instagram-fill"></i></a>
                                        <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Doctors Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>{{ __('index.faq_title') }}</h2>
                    <p>{{ __('index.faq') }}</p>
                </div>

                <div class="faq-list">
                    <ul>
                        @foreach ($faq_helper->getAllFaqs() as $index => $faq)
                            <li data-aos="{{ $index == 0 ? 'fade-up' : '' }}">
                                <i class="bx bx-help-circle icon-help"></i>
                                <a data-bs-toggle="collapse" class="collapse"
                                    data-bs-target="#faq-list-{{ $index + 1 }}">
                                    {{ $faq->faq_question }}
                                    <i class="bx bx-chevron-down icon-show"></i>
                                    <i class="bx bx-chevron-up icon-close"></i>
                                </a>
                                <div id="faq-list-{{ $index + 1 }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                                    data-bs-parent=".faq-list">
                                    <p>
                                        {!! $faq->faq_answer !!}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container">

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{ asset('general_Assets/img/testimonials/testimonials-1.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                        rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                        risus at semper.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{ asset('general_Assets/img/testimonials/testimonials-2.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                        cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                        legam anim culpa.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{ asset('general_Assets/img/testimonials/testimonials-3.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                        veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                        minim.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{ asset('general_Assets/img/testimonials/testimonials-4.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                        dolore labore illum veniam.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="{{ asset('general_Assets/img/testimonials/testimonials-5.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                        veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                        culpa fore nisi cillum quid.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container">

                <div class="section-title">
                    <h2>{{ __('index.gallery_title') }}</h2>
                    <p>{{ __('index.gallery') }}</p>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row g-0">
                    @foreach ($gallery_category_helper->getPatientCarePhotos() as $photo)
                        <div class="col-lg-3 col-md-4">
                            <div class="gallery-item">
                                <a href="{{ asset($photo->file) }}" class="galelry-lightbox">
                                    <img src="{{ asset($photo->file) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Gallery Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>{{ __('index.contact_title') }}</h2>
                    <p>{{ __('index.contact') }}</p>
                </div>
            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 350px;"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                    frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="container">
                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address mb-4">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                @foreach ($siteinfo_helper->getSiteAddress() as $siteAddress)
                                    <p>{{ $siteAddress->value }}</p>
                                @endforeach
                            </div>

                            @foreach ($siteinfo_helper->getSiteContact() as $siteContact)
                                <div class="mb-4">
                                    {!! $siteContact->icon !!}
                                    <h4>{{ $siteContact->label }}:</h4>
                                    <p>{{ $siteContact->value }}</p>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <form action="{{ route('feedback.store') }}" method="post" role="form"
                            id="user_feedback_form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="fullname" class="form-control"
                                        value="{{ old('fullname') }}" id="name" placeholder="Your Fullname">
                                    @error('fullname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" id="email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                    id="subject" placeholder="Subject">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="submitBtn">Send Message</button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </section>
    </main><!-- End #main -->
@endsection
