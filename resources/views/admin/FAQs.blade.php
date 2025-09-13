@extends('admin.layouts.app')

@section('title', 'Admin FAQs')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Frequently Asked Questions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">FAQs</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section faq">
            <div class="row">

                <!-- Basic Questions -->
                <div class="col-lg-6">
                    <div class="card basic">
                        <div class="card-body">
                            <h5 class="card-title">Basic Questions</h5>

                            <div>
                                <h6>1. What is Digital Product Marketplace?</h6>
                                <p>It’s a platform where you can buy and sell digital products such as eBooks,
                                    templates,
                                    courses, and software.</p>
                            </div>

                            <div class="pt-2">
                                <h6>2. Do I need an account to purchase?</h6>
                                <p>Yes, you need to create an account to purchase and access your files later.</p>
                            </div>

                            <div class="pt-2">
                                <h6>3. Can I sell my own digital products?</h6>
                                <p>Absolutely! Once you register as a seller, you can upload your products and manage
                                    sales
                                    from your dashboard.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Payment & Orders -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payments & Orders</h5>

                            <div class="accordion accordion-flush" id="faq-payments">

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" data-bs-target="#faq-pay-1"
                                            type="button" data-bs-toggle="collapse">
                                            What payment methods are available?
                                        </button>
                                    </h2>
                                    <div id="faq-pay-1" class="accordion-collapse collapse" data-bs-parent="#faq-payments">
                                        <div class="accordion-body">
                                            We support multiple payment methods such as credit/debit cards (Visa,
                                            MasterCard), PayPal, and local e-wallets.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" data-bs-target="#faq-pay-2"
                                            type="button" data-bs-toggle="collapse">
                                            Can I get a refund after purchase?
                                        </button>
                                    </h2>
                                    <div id="faq-pay-2" class="accordion-collapse collapse" data-bs-parent="#faq-payments">
                                        <div class="accordion-body">
                                            Since digital products are delivered instantly, refunds are only possible if
                                            there’s a technical issue preventing access to the product.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" data-bs-target="#faq-pay-3"
                                            type="button" data-bs-toggle="collapse">
                                            Where can I find my purchased files?
                                        </button>
                                    </h2>
                                    <div id="faq-pay-3" class="accordion-collapse collapse" data-bs-parent="#faq-payments">
                                        <div class="accordion-body">
                                            All purchased files are available in your account under the <strong>"My
                                                Purchases"</strong> section and can be downloaded anytime.
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Accounts & Security -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Accounts & Security</h5>

                            <div class="accordion accordion-flush" id="faq-accounts">

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" data-bs-target="#faq-acc-1"
                                            type="button" data-bs-toggle="collapse">
                                            Is my personal information secure?
                                        </button>
                                    </h2>
                                    <div id="faq-acc-1" class="accordion-collapse collapse" data-bs-parent="#faq-accounts">
                                        <div class="accordion-body">
                                            Yes, we use SSL encryption and secure payment gateways to protect your
                                            personal
                                            data and transactions.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" data-bs-target="#faq-acc-2"
                                            type="button" data-bs-toggle="collapse">
                                            Can I change my password?
                                        </button>
                                    </h2>
                                    <div id="faq-acc-2" class="accordion-collapse collapse" data-bs-parent="#faq-accounts">
                                        <div class="accordion-body">
                                            Yes, you can change your password anytime from your account settings to keep
                                            your account secure.
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->

@endsection
