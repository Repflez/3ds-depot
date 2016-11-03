<!DOCTYPE html>
<html>
	<head>
		{% block head %}
			<title>{% block title %}{% endblock %} - 3DS Depot</title>
		{% endblock %}
	</head>
	<body>
		<div id="content">{% block content %}{% endblock %}</div>
		<div id="footer">
			{% block footer %}
				&copy; Copyright 2016 by Repflez | <a href="https://github.com/Repflez/3ds-depot">source code</a>
			{% endblock %}
		</div>
	</body>
</html>