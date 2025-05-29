<?php
session_start();
include("db_connect.php");

// Prevent access if not logged in as voter
if (!isset($_SESSION['RMAQuser_id']) || !isset($_SESSION['RMAQlogged_in']) || $_SESSION['RMAQlogged_in'] !== true) {
    header("Location: index.php");
    exit;
}

// Hardcode the position name (e.g., Senator)
$position_name = 'Senator';

// Fetch all candidates with that position
$escaped_position = $RMAQ_conn->real_escape_string($position_name);
$sql_candidates = "SELECT * FROM candidate_table WHERE election_position = '$escaped_position'";
$res_candidates = $RMAQ_conn->query($sql_candidates);

$candidates = [];
if ($res_candidates && $res_candidates->num_rows > 0) {
    while ($cand = $res_candidates->fetch_assoc()) {
        $candidates[] = $cand;
    }
} else {
    die("No candidates found for position: $position_name");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Local Ballot - College of Information and Computing Sciences</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f9f9f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .header-bar {
      background-color: #fdb913;
      color: #000;
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      font-weight: 600;
    }
    .header-bar img {
      height: 50px;
      width: auto;
    }
    .header-text {
      font-size: 1.1rem;
      line-height: 1.2;
    }
    .ballot-container {
      max-width: 720px;
      margin: 2rem auto 4rem auto;
      background: white;
      border-radius: 8px;
      box-shadow: 0 6px 12px rgb(0 0 0 / 0.1);
      padding: 1rem 2rem 2rem 2rem;
    }
    .ballot-header {
      background-color: #fdb913;
      padding: 0.7rem 1rem;
      border-radius: 6px 6px 0 0;
      font-weight: 700;
      font-size: 1.25rem;
      text-align: center;
      user-select: none;
    }
    .ballot-subtitle {
      text-align: center;
      font-weight: 500;
      margin-top: 0.1rem;
      margin-bottom: 1.5rem;
      font-size: 1rem;
      color: #333;
    }
    .position-title {
      font-weight: 600;
      margin-bottom: 0.6rem;
      font-size: 1rem;
    }
    hr.divider {
      margin-top: 0;
      margin-bottom: 1rem;
      border: 0;
      border-top: 1px solid #ddd;
    }
    .candidate-option {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      margin-bottom: 0.6rem;
    }
    .candidate-label {
      flex: 1;
      font-size: 0.95rem;
      font-weight: 500;
      color: #222;
      user-select: none;
    }
    .form-check-input {
      flex-shrink: 0;
      margin-top: 0.3rem;
      margin-right: 0.5rem;
    }
    .btn-container {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 1.8rem;
    }
    .btn-clear {
      background-color: #6c757d;
      border: none;
      padding: 0.5rem 1.2rem;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-clear:hover {
      background-color: #5a6268;
    }
    .btn-submit {
      background-color: #198754;
      border: none;
      padding: 0.5rem 1.5rem;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
      background-color: #146c43;
    }
  </style>

  <script>
    // Limit voter to max 12 selections
    document.addEventListener('DOMContentLoaded', () => {
      const maxSelections = 12;
      const checkboxes = document.querySelectorAll('input[type="checkbox"].candidate-checkbox');

      checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          const checkedCount = Array.from(checkboxes).filter(c => c.checked).length;
          if (checkedCount > maxSelections) {
            alert(`You can only select up to ${maxSelections} candidates.`);
            cb.checked = false;
          }
        });
      });
    });
  </script>
</head>
<body>

<header class="header-bar">
  <img src="images/ust-commission-logo.png" alt="UST Commission on Elections Logo" />
  <div class="header-text">
    <div>University of Santo Tomas</div>
    <div style="font-weight: 600;">Commission on Elections</div>
  </div>
</header>

<div class="ballot-container">
  <div class="ballot-header">COLLEGE OF INFORMATION AND COMPUTING SCIENCES</div>
  <div class="ballot-subtitle">Local Ballot</div>

  <form action="submit_vote.php" method="POST" id="voteForm">
    <div class="position-block">
      <p class="position-title"><?php echo htmlspecialchars($position_name); ?></p>
      <hr class="divider" />
      <?php foreach ($candidates as $candidate): ?>
        <div class="form-check candidate-option">
          <input
            type="checkbox"
            class="form-check-input candidate-checkbox"
            name="<?php echo htmlspecialchars(strtolower(str_replace(' ', '_', $position_name))) . '[]'; ?>"
            id="candidate<?php echo intval($candidate['candidate_id']); ?>"
            value="<?php echo intval($candidate['candidate_id']); ?>"
          />
          <label
            class="candidate-label form-check-label"
            for="candidate<?php echo intval($candidate['candidate_id']); ?>"
          >
            <?php echo htmlspecialchars($candidate['candidate_name']); ?>
            (<?php echo htmlspecialchars($candidate['party_affiliation']); ?>)
          </label>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="btn-container">
      <button type="reset" class="btn-clear">CLEAR</button>
      <button type="submit" class="btn-submit">SUBMIT</button>
    </div>
  </form>
</div>

</body>
</html>