<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analisa FP-Growth</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Analisa FP-Growth</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Form Input untuk Min Support dan Confidence -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" action="<?= base_url('transaksi/analisa_fp_growth'); ?>">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="min_support">Minimum Support</label>
                                <input type="number" step="0.01" class="form-control" id="min_support" name="min_support" placeholder="Min Support (Contoh: 1)" value="<?= isset($min_support) ? $min_support : '' ?>" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="confidence">Confidence</label>
                                <input type="number" step="0.01" class="form-control" id="confidence" name="confidence" placeholder="Confidence (Contoh: 0.5)" value="<?= isset($confidence) ? $confidence : '' ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Generate</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menampilkan Frequent Itemsets -->
        <?php if (!empty($frequent_itemsets)) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <b class="card-title">Frequent Itemsets</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Item</th>
                                    <th class="text-center">Support Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($frequent_itemsets as $item => $count) : ?>
                                    <tr>
                                        <td><?= $item; ?></td>
                                        <td class="text-center"><?= $count; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Menampilkan Association Rules -->
        <?php if (!empty($rules)) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <b class="card-title">Association Rules</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Rule</th>
                                    <th>Support</th>
                                    <th class="text-center">Confidence</th>
                                    <th>Benchmark</th>
                                    <th class="text-center">Lift Ratio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($benchmark_lift_ratio as $rule) : ?>
                                    <tr>
                                        <td><?= $rule['rule']; ?></td>
                                        <td><?= $rule['support']; ?></td>
                                        <td class="text-center"><?= $rule['confidence']; ?></td>
                                        <td><?= $rule['benchmark']; ?></td>
                                        <td class="text-center"><?= $rule['lift_ratio']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Menampilkan Hasil Akhir Analisa FP-Growth -->
        <?php if (!empty($specifications)) : ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <b class="card-title">Hasil Analisa FP-Growth</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Spesifikasi</th>
                            <th class="text-center">Lift Ratio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($specifications as $spec) : ?>
                            <tr>
                                <td><?= nl2br(htmlspecialchars($spec['specification'])); ?></td>
                                <td class="text-center"><?= htmlspecialchars($spec['lift_ratio']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
    </div>
</div>
</body>
</html>
