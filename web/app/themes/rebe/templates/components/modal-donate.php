<div class="o-overlay c-donate__lightbox js-lightbox--donate">
    <div class="o-overlay__content c-donate-modal">
      <div class="c-post-navigation c-post-navigation__close o-icon c-icon-close t-medium-gray js-lightbox-close">
        <?php the_field('close_button_label', 'option'); ?>
      </div>
        <h1 class="o-heading c-donate-modal__title">
          <?php the_field('donate_modal_title', 'option'); ?>
        </h1>
        <p class="o-paragraph c-donate-modal__text"><?php the_field('donate_modal_text', 'option'); ?></p>

      <div class="c-donate-modal__payment-options">
        <div class="c-donate-modal__paypal">
        <?php if (get_field('donate_modal_paypal_button_url', 'option')): ?>
          <a class="o-btn c-donate__paypal-button" href="<?php the_field('donate_payment_option_1_button_url', 'option'); ?>">
            <div class="c-donate__paypal-icon o-icon c-icon-paypal"></div>
          </a>
          <img class="c-donate__paypal-badges" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />
        <?php endif; ?>
      </div>
        <div class="c-donate-modal__tax-free">
          <a class="o-btn o-btn--large t-indigo--focus" a href="<?php the_field('donate_payment_option_2_button_url', 'option'); ?>">
            <?php the_field('donate_payment_option_2_button_text', 'option'); ?>
          </a>
          <p class="o-paragraph">
            <?php the_field('donate_payment_option_2_text', 'option'); ?>
          </p>
        </div>
    </div>
</div>
