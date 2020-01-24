<footer>


	<div class="row footer-main">

        <div class="col-six tab-full left footer-desc">

            <div class="footer-logo"></div>
            Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Quaerat voluptas autem necessitatibus vitae aut.

        </div>

        <div class="col-six tab-full right footer-subscribe">

            <h4>Cadastre-se aqui!</h4>
            <p>Cadastre-se na nossa newsletter e fique por dentro de cada lançamento.</p>

            <div class="subscribe-form">
                <form id="subscribe" action="<?php echo base_url('contato/subscribe') ?>" method="POST" enctype="multipart/form-data" class="group form-field" novalidate="novalidate">
                    <input type="email" name="email" id="email" required placeholder="Email" minlength="8">
					<button type="submit" name="subscribe" class="btn--primary">Inscreva-se</button>
					<div class="submit-loader">
						<div class="text-loader">Enviando...</div>
						<div class="s-loader">
							<div class="bounce1"></div>
							<div class="bounce2"></div>
							<div class="bounce3"></div>
						</div>
					</div>
                </form>
				<div class="message-warning">

				</div>
				<div class="message-success">

				</div>
			</div>

        </div>

    </div> <!-- end footer-main -->

    <div class="row footer-bottom">

        <div class="col-twelve">
            <div class="copyright">
                <span>© Copyright Mablix 2020</span>
                <span>Desenvolvidor por <a href="#">Thyago Hoffman</a></span>
            </div>

            <div class="go-top">
                <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
            </div>
        </div>

    </div> <!-- end footer-bottom -->

</footer> 
