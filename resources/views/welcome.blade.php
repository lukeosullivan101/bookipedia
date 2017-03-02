@extends('layouts.app')

@section('content')
<div id="homepage">

    <section id="header">
        <div class="row">
          <div class="container">
              <div class="block">
                <img alt="Bookipedia" src="../uploads/logos/written.png">
                <p>Read. Learn. Create</p>
              </div>
          </div>
        </div>
    </section>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h1 class="section-heading">What is Bookipedia?</h1>
                    <div class="top"></div>
                    <p>Bookipedia is an online platform, based around a social community with a shared love of reading and books. We are striving
                    to disseminate the collective knowledge and insights that are found in books of all genres through high quality book summaries
                    , enabling our users to enrich their lives. We crowdsource all of our book summaries for one simple reason -</p>
                    <p class="slogan">You are the world's leading expert on your favorite books</p>
                </div>
            </div>
        </div>
    </section>

        <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>What We Do</h1>
                    <div class="top"></div>
                </div>
            </div>
        </div>
        <div class="container icons">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-file-text"></i>
                        <h3>Book Summaries</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-camera-retro"></i>
                        <h3>Blog</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-users"></i>
                        <h3>Forums</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section id="books">
       <div class="row">
         <div class="col-md-7 col-sm-12">
           <div class="block">
              <h3>Our Book Summaries</h3>
              <p>Book summaries are the bedrock of Bookipedia. In modern times people can’t dedicate as much time as they would like to reading. Therefore we are committed to building up a repository of high quality, crowd sourced book summaries so our users can learn the key messages the world’s greatest books have to offer.</p>
           </div>
         </div>
         <div class="col-md-5 col-sm-12">
           <div class="block">
             <img src="/uploads/write-bg.jpg" alt="Books">
           </div>
         </div>
       </div>
    </section>

    <section id="blog">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-6">
            <h3>Our Blog</h3>
            <p>The Bookipedia Blog is used for everything Bookipedia related other than our summaries. We use our blog to post anything from the latest news and what's going on at Bookipedia, to reviews on the latest books, so keep an eye out for new content!</p>
          </div>
        </div>
      </div>
    </section>

    <section id="forums">
       <div class="row">
         <div class="col-md-5 col-sm-12">
           <div class="block">
             <img src="/uploads/create-bg.jpg" alt="Books">
           </div>
         </div>
         <div class="col-md-7 col-sm-12">
           <div class="block">
              <h3>Our Forums</h3>
              <p>The Bookipedia forum is a hub of online debate and discussion of everything and anything related to books. Want to discuss your favourite book, favourite author or the latest release in the world of literature? Then our forum is the place for you.</p>
           </div>
         </div>
       </div>
    </section>
  
    <section id="write">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="block">
              <h3>Get involved, become a Bookipedia Writer!</h3>
              <p>Bookipedia is powered by its writers and the content people submit. We want your opinions and views on your favorite books. Get involved in Bookipedia by submitting summaries of your own, and take the next step on your writing journey.</p>
              <a href="{{ route('write') }}" class="btn btn-default btn-write">Write For Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h1 class="">Get In Touch!</h1>
                    <hr class="primary">
                    <p>If you have any questions, queries, or concerns surronding Bookipedia, then don't hesitate to contact us using the email below. Bookipedia is always endeavouring to grow alongside its user base, so any thoughts or suggestions you have on how we can improve Bookipedia for you, are more than welcome!</p>
                </div>
                <div class="col-lg-12 text-center">
                    <i class="fa fa-envelope-o fa-4x"></i>
                    <p><a href="mailto:info.bookipedia@gmail.com">info.bookipedia@gmail.com</a></p>
                </div>
            </div>
        </div>
    </section>

</section>

</div><!-- Homepage -->
@endsection
           


