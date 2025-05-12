@extends('layout')

@section('title', 'Liên hệ')
@section('content')
    <section class="py-5">
    <div class="container">
      <div class="row mb-5 align-items-center">
        <div class="col-12 col-md-12 text-center mb-5">
          <h1 class="fs-2 text-center theme-text-primary mb-0 max-1">Liên hệ với chúng tôi</h1>
        </div>
        <div class="col-12 col-lg-4 mb-3 mb-md-0">
          <div class="d-flex flex-column align-items-center text-center border p-4 mb-4">
            <i class="bi bi-envelope fs-1"></i>
            <h2 class="mb-3 fw-bold fs-6">Gửi email cho chúng tôi
            </h2>
            <a href="mailto:support@example.com"
              class="mb-0 max-1 theme-text-accent-one font-medium">Support@example.com</a>
          </div>
          <!-- section end -->
          <div class="d-flex flex-column align-items-center text-center border p-4 mb-4">
            <i class="bi bi-telephone fs-1"></i>
            <h2 class="mb-3 fw-bold fs-6">Chăm sóc khách hàng
            </h2>
            <span class="mb-0 max-1 theme-text-accent-one font-medium">0976.717.688</span>
          </div>
          <!-- section end -->
          <div class="d-flex flex-column align-items-center text-center border p-4 mb-4 mb-lg-0">
            <i class="bi bi-chat-dots fs-1"></i>
            <h2 class="mb-3 fw-bold fs-6">Trò chuyện với chúng tôi
            </h2>
            <span class="mb-0 max-1 theme-text-accent-one font-medium">Liên hệ ngay với ZALO
              <br>
              24/7</span>
          </div>
          <!-- section end -->
        </div>
        <!-- contact form section section -->
        <div class="col-12 col-lg-8">
          <div class="border p-5">
            <h3 class="mb-3">ĐỂ LẠI TIN NHẮN CỦA BẠN</h3>
            <p class="mb-5">Vui lòng để lại thông tin chi tiết của bạn và chúng tôi sẽ trả lời bạn sớm nhất có thể</p>
            <form id="contact-form" method="post" action="{{route('contacts.store')}}" class="send">
              @csrf
              <div class="messages"></div>
              <div class="controls">
                <div class="form-group mb-4">
                  <input id="form_name" type="text" name="name" class="form-control custum-input"
                    placeholder="Tên của bạn" required="required" data-error="Name is required.">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group mb-4">
                  <input id="form_email" type="email" name="email" class="form-control custum-input"
                    placeholder="Email của bạn" required="required" data-error="Valid Email is required.">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group mb-4">
                  <input id="form_phone" type="text" name="phone" class="form-control custum-input"
                    placeholder="Số điện thoại" required="required" data-error="Please specify your Phone.">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group mb-4">
                  <textarea id="form_message" name="message" class="form-control" placeholder="Nội dung"
                    rows="3" required="required" data-error="Please, leave us a message."></textarea>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="mb-1">
                  <button type="Submit" value="Send message"
                    class="w-50 btn custom-btn-primary theme-border-secondary theme-text-white button-effect fw-bold">
                    Gửi tin nhắn
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- map section -->
  <div class="mb-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.5404266061414!2d-0.12403836556756871!3d51.50330055369121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604b900d26973%3A0x4291f3172409ea92!2slastminute.com%20London%20Eye!5e0!3m2!1sen!2sin!4v1662441698175!5m2!1sen!2sin"
            style="border:0; width: 100%; height: 500px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
@endsection
