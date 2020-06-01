<?php 
    $all_published_slider=DB::table('tbl_slider')
    ->where('publication_status',1)
    ->get(); 

?>  


<section id="slider"><!--slider-->
    <div class="container">
      <div class="row">

        <div id="carousel-example-generic" class="carousel slide " data-ride="carousel" style="width: 1000px" >
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($all_published_slider as $v_slider )
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  @foreach( $all_published_slider as $v_slider )
                  <div class="item {{$loop->first ? 'active' : '' }}">
                    <img src="{{ $v_slider->slider_image }}"  style="height: 300px" class="sli_image">                    
                  </div>
                  @endforeach                  
                </div>

                <!-- Controls -->
                
            </div>

      </div>
    </div>
  </section><!--/slider-->