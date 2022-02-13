import React from "react";
import ReactDOM from "react-dom";
import MovieList from "./MovieList/MovieList";
import {
    QueryClient,
    QueryClientProvider,
} from 'react-query'
import {AppBar, Box, Container, Toolbar, Typography} from "@mui/material";

const App = () => {
    const queryClient = new QueryClient()

    return <React.Fragment>
        <QueryClientProvider client={queryClient}>
            <AppBar>
                <Container>
                    <Toolbar>
                        <Typography variant={"h5"}>
                            Top 210 Movies
                        </Typography>
                    </Toolbar>
                </Container>
            </AppBar>
            <main>
                <Box
                    sx={{
                        bgcolor: 'background.paper',
                        pt: 8,
                        pb: 6,
                    }}
                >
                    <Container>
                        <Box>
                            <MovieList/>
                        </Box>
                    </Container>
                </Box>
            </main>
        </QueryClientProvider>
    </React.Fragment>
}

export default App

if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
