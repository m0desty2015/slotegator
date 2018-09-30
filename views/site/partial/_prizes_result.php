<h1>Prizes result</h1>
<p>
    This is the Prizes result page.
</p>
<center>
    <div class="row" style="max-width: 400px;">
        <div class="span4">
            <div class="alert alert-success" role="alert">
                <?= $result['message']; ?>
                <?php if ( ! empty($result['image'])): ?>
                    <img src="<?= $result['image']; ?>">
                <?php endif; ?>
            </div>
            <div class="btn_container">
                <p>
                    <button class="btn btn-large btn-primary got" url="<?= $result['url']; ?>"> GOT PRIZE</button>
                    <button class="btn-large btn btn-warning refuze"> REFUZE</button>
                </p>
            </div>
        </div>
    </div>
</center>