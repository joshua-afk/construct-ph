@push('styles')
<style>
	.settings-sidebar ul > li{
		border-radius: 15px;
	}
	.settings-sidebar ul > li.active{
		background-color: rgb(145, 170, 0, 0.2);
	}
	.settings-sidebar ul > li:hover{
		background-color: rgb(145, 170, 0, 0.15);
	}
	.settings-sidebar ul > li > a:hover{
		text-decoration: none;
	}
</style>
@endpush

<div class="panel">
	<div class="settings-sidebar p-3">
		<h4 class="px-2 text-muted">Settings</h4>
		<ul>
			<li class="px-3 py-2 {{ (\Route::current()->uri == 'settings') ? 'active' : null }}">
				<a href="/settings">
					<i class="fas fa-layer-group"></i>&ensp;&ensp;General
				</a>
			</li>
			<li class="px-3 py-2 {{ (\Route::current()->uri == 'settings/personal-info') ? 'active' : null }}">
				<a href="/settings/personal-info">
					<i class="far fa-id-card"></i>&ensp;&ensp;Personal Info
				</a>
			</li>
			<li class="px-3 py-2 {{ (\Route::current()->uri == 'settings/security') ? 'active' : null }}">
				<a href="/settings/security">
					<i class="fas fa-user-lock"></i>&ensp;&ensp;Security
				</a>
			</li>
		</ul>
	</div>
</div>