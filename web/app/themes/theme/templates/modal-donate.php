<div class="o-lightbox c-lightbox--donate js-lightbox--donate">
    <div class="o-lightbox__content-wrapper c-lightbox__content-wrapper--donate">
      <div class="c-lightbox__nav c-lightbox__nav--close o-icon c-icon-close-medium-gray js-lightbox-close">
        <?php the_field('close_button_label', 'option'); ?>
      </div>
        <h1 class="o-heading c-donate-modal__title">
          <?php the_field('donate_modal_title', 'option'); ?>
        </h1>
        <p class="o-paragraph c-donate-modal__text"><?php the_field('donate_modal_text', 'option'); ?></p>

      <div class="o-row c-donate-modal__payment-options">
        <div class="c-donate-modal__paypal">
        <?php if (get_field('donate_modal_paypal_button_url', 'option')): ?>
          <a class="o-btn c-btn--paypal" href="<?php the_field('donate_modal_paypal_button_url', 'option'); ?>">
            <div class="c-donate-modal__paypal-icon o-icon c-icon-paypal"></div>
          </a>
          <img class="c-donate-modal__paypal-badges" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />
        <?php endif; ?>
      </div>
        <div class="c-donate-modal__tax-free">
          <a class="o-btn c-btn--large c-btn--indigo" a href="<?php the_field('donate_modal_payment_option1_button_link', 'option'); ?>">
            <?php the_field('donate_modal_payment_option1_button_label', 'option'); ?>
          </a>
          <p class="o-paragraph">
            <?php the_field('donate_modal_payment_option1_text', 'option'); ?>
          </p>
        </div>
    </div>
</div>
