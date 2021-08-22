<?php if (!empty($address->errors)) : ?>
    <?php foreach ($address->errors as $error) : ?>
        <p id="php-message"><?php echo $error ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="post" id="contact-form">
    <div id="email">
        <input id="email-field" name="email" placeholder="Type your email address here..." value="<?= htmlspecialchars($address->email); ?>">
        <button class="arrow-button" type="submit" name="sub">
            <svg class="svg-img" width="24" height="14" viewBox="0 0 24 14" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.7071 0.2929C17.3166 -0.0976334 16.6834 -0.0976334 16.2929 0.2929C15.9023 0.683403 15.9023 1.31658 16.2929 1.70708L20.5858 5.99999H1C0.447693 5.99999 0 6.44772 0 6.99999C0 7.55227 0.447693 7.99999 1 7.99999H20.5858L16.2929 12.2929C15.9023 12.6834 15.9023 13.3166 16.2929 13.7071C16.6834 14.0976 17.3166 14.0976 17.7071 13.7071L23.7071 7.70708C24.0977 7.31658 24.0977 6.6834 23.7071 6.2929L17.7071 0.2929Z" />
            </svg>
        </button>
    </div>
    <p id="validation-message"></p>
    <div class="tos">
        <input id="check-active" type="checkbox" name="checkbox" <?php if (isset($address->checkbox)) : ?>checked<?php endif; ?>>
        <lable name="check" class="check-terms">
            I agree to <a href="#" class="check-link">terms of service</a>
        </lable>
    </div>
</form>