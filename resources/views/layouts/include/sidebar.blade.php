<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    @auth
                    <a href="#" class="media-left"><img src="{{ asset('assets/images/profiles') }}/default.png" class="img-circle img-sm" alt="image"></a>
                    @endauth
                    <div class="media-body" style="vertical-align:middle">
                        @auth
                        <span class="media-heading text-semibold">{{ Auth::user()->name}}</span>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->

                    <li class="{{ (request()->is('users') || request()->is('home') || request()->is('/') ) ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="icon-users"></i> <span>User</span></a></li>

                    <li class="{{ (request()->is('clients') ) ? 'active' : '' }}"><a href="{{ route('clients.index') }}"><i class="icon-users"></i> <span>Clients</span></a></li>

                    <li class="{{ (request()->is('staff') ) ? 'active' : '' }}"><a href="{{ route('staff.index') }}"><i class="icon-users"></i> <span>Staff</span></a></li>

                   <li class="{{ (request()->is('services') || request()->is('services/*/edit')) ? 'active' : '' }}"><a href="{{ route('services.index') }}"><i class="icon-cog"></i> <span>Services</span></a></li>

                    <li class="{{ (request()->is('invoices') ) ? 'active' : '' }}"><a href="{{ route('invoices.index') }}"><i class="icon-users"></i> <span>Invoices</span></a></li>

                    <!-- <li class="{{ (request()->is('products') ) ? 'active' : '' }}"><a href="{{ route('products.index') }}"><i class="icon-users"></i> <span>Products</span></a></li>

                    <li class="{{ (request()->is('quotations') ) ? 'active' : '' }}"><a href="{{ route('quotations.index') }}"><i class="icon-users"></i> <span>Quotation</span></a></li> 

                    <li class="{{ (request()->is('affirmation-quote')|| request()->is('affirmation-quote/create') || request()->is('affirmation-quote/*/edit')) ? 'active' : '' }}"><a href="{{ route('affirmation-quote.index') }}"><i class="icon-stack-text"></i> <span>Affirmation Quotes</span></a></li>

                    <li class="{{ (request()->is('affirmation-image') || request()->is('affirmation-image/create') || request()->is('affirmation-image/*/edit')) ? 'active' : '' }}"><a href="{{ route('affirmation-image.index') }}"><i class="icon-images2"></i> <span>Affirmation Images</span></a></li>


                    <li class="{{ (request()->is('payments')) ? 'active' : '' }}"><a href="{{ route('payments.index') }}"><i class="icon-coin-dollar"></i> <span>Payment & Transaction</span></a></li> --> 
                    
                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->