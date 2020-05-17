<template>
	<div>
		<ul>
			<li><a v-on:click="$router.push('/dashboard').catch(()=>{})">Dashboard</a></li>
			<li><a v-on:click="$router.push({name: 'categoryMain'}).catch(()=>{})">Category</a></li>
			<li><a v-on:click="$router.push({name: 'financialMain'}).catch(()=>{})">Financial</a></li>
			<ul>
				<li><a v-on:click="$router.push({name: 'financialStatisticMain'}).catch(()=>{})">Financial Statistic</a></li>
			</ul>
		</ul>
	</div>
</template>