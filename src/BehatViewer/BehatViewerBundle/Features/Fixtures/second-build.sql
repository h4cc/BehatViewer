INSERT INTO `build` (`id`, `stat_id`, `project_id`, `date`) VALUES
(2, 2, 1, '1970-01-01 00:00:00');

INSERT INTO `feature` (`id`, `build_id`, `stat_id`, `name`, `slug`, `description`) VALUES
(3, 2, 3, 'Passed', 'passed', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere mollis quam sed rhoncus. Lorem ipsum dolor sit amet, consectetur.'),
(4, 2, 4, 'Failed', 'failed', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere mollis quam sed rhoncus. Lorem ipsum dolor sit amet, consectetur.');

INSERT INTO `scenario` (`id`, `feature_id`, `name`, `slug`, `status`) VALUES
(3, 3, 'Passed', 'passed', 'passed'),
(4, 4, 'Failed', 'failed', 'failed');

INSERT INTO `step` (`id`, `scenario_id`, `type`, `background`, `clean_text`, `text`, `file`, `line`, `status`, `definition`, `snippet`, `screen`, `exception`) VALUES
(9,  3, 'Given', 0, 'I am on "/foo/"',    'I am on "/foo/"',    '/foo/bar/passed.feature', '5', 'passed',  'foo\\bar\\Context\\FeatureContext::visit()', '', '', ''),
(10, 3, 'Then',  0, 'I should see "foo"', 'I should see "foo"', '/foo/bar/passed.feature', '6', 'passed',  'foo\\bar\\Context\\FeatureContext::see()',   '', '', ''),
(11, 3, 'And',   0, 'I should see "bar"', 'I should see "bar"', '/foo/bar/passed.feature', '7', 'passed',  'foo\\bar\\Context\\FeatureContext::see()',   '', '', ''),
(12, 4, 'Given', 0, 'I am on "/foo/"',    'I am on "/foo/"',    '/foo/bar/passed.feature', '5', 'passed',  'foo\\bar\\Context\\FeatureContext::visit()', '', '', ''),
(13, 4, 'Then',  0, 'I should see "foo"', 'I should see "foo"', '/foo/bar/passed.feature', '6', 'passed',  'foo\\bar\\Context\\FeatureContext::see()',   '', '', ''),
(14, 4, 'And',   0, 'I should see "bar"', 'I should see "bar"', '/foo/bar/passed.feature', '7', 'passed',  'foo\\bar\\Context\\FeatureContext::see()',   '', '', ''),
(15, 4, 'And',   0, 'I should see "baz"', 'I should see "baz"', '/foo/bar/passed.feature', '8', 'failed',  'foo\\bar\\Context\\FeatureContext::see()',   '', '', 'This is the exception message'),
(16, 4, 'And',   0, 'I should see "boo"', 'I should see "boo"', '/foo/bar/passed.feature', '9', 'skipped', 'foo\\bar\\Context\\FeatureContext::see()',   '', '', '');

INSERT INTO `build_stat` (`id`, `features`, `features_passed`, `features_failed`, `scenarios`, `scenarios_passed`, `scenarios_failed`, `steps`, `steps_passed`, `steps_failed`, `steps_skipped`, `steps_undefined`, `steps_pending`) VALUES
(2, 2, 1, 1, 2, 1, 1, 8, 6, 1, 1, 0, 0);

INSERT INTO `feature_stat` (`id`, `scenarios`, `scenarios_passed`, `scenarios_failed`, `steps`, `steps_passed`, `steps_failed`, `steps_skipped`, `steps_undefined`, `steps_pending`) VALUES
(3, 1, 1, 0, 3, 3, 0, 0, 0, 0),
(4, 1, 0, 1, 5, 3, 1, 1, 0, 0);