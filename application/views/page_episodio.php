<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<!-- Animes
		================================================== -->
        <section id="episodio" class="s-home target-section" data-parallax="scroll" data-image-src="<?php echo base_url($Imagem_Destacada) ?>" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

            <!-- <a href="#0" class="header-nav__close" title="Fechar"><span>Fechar</span></a> -->

            <div class="overlay"></div>
            <div class="shadow-overlay"></div>

            <video class="afterglow" data-autoresize="none" id="myvideo" poster="<?php echo base_url($Imagem_Destacada) ?>" width="1920" height="1080" autoplay="autoplay" preload="auto">
              <source type="video/mp4" src="<?php echo base_url('assets/videos/categoria_04/anime_04/' . $h2) ?>" />
              <source type="video/mp4" src="https://vjs.zencdn.net/v/oceans.mp4" data-quality="hd"/>
            </video>
            <!-- <a class="afterglow" href="#myvideo">Launch lightbox</a> -->

            <button onclick="javascript:history.back();" type="button" class="btn-voltar" title="Voltar aos Episódios" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> &nbsp; Voltar</button>
            
            <div class="home-content">

                <div class="row home-content__main no-padding">

                    <h1><?php echo $h2 ?></h1>

                </div>

            </div> <!-- end home-content -->

        </section> <!-- end s-home -->

	</body>

	<?php echo $scripts ?>

    <script type="text/javascript">
        $(document).ready(function() {
          
            $(this).hover(
                function (){
                    $('#episodio .overlay').fadeOut();
                    $('#episodio .home-content').fadeOut();
                    $('#episodio .shadow-overlay').fadeOut();
                    $('#episodio .btn-voltar').fadeIn();
                    $('#episodio .vjs-afterglow-skin.vjs-has-started .vjs-control-bar').fadeIn();
                },
                function(){
                    if ( afterglow.getPlayer('myvideo').paused() == true ) {
                        setTimeout(function() {
                            $('#episodio .overlay').fadeIn();
                            $('#episodio .home-content').fadeIn();
                            $('#episodio .shadow-overlay').fadeIn();
                            $('#episodio .vjs-afterglow-skin.vjs-has-started .vjs-control-bar').fadeOut();
                            $('#episodio .btn-voltar').fadeOut();
                        }, 5000); 
                    }
                }
            );

            $(document).keydown(function(){

                if ( event.which == 77 ){
                    if ( afterglow.getPlayer('myvideo').volume() == 0 ){
                        afterglow.getPlayer('myvideo').volume(1);
                    }
                    else {
                        afterglow.getPlayer('myvideo').volume(0);
                    }
                }

            });

        });
    </script>

</html>
